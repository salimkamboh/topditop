<?php

namespace App\Services;

use App\Helpers\ImportRow;
use App\Location;
use App\Manufacturer;
use App\Package;
use App\Profile;
use App\Store;
use App\User;
use App\Origin;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ImportService
{
    use WritesOutputToConsole;

    const INVALID_LOCATION_ID = -99999;

    /**
     * @var Package
     */
    public $lightPackage = null;

    /**
     * @var \App\User []
     */
    public $users = [];

    /**
     * @var string []
     */
    public $takenEmails = [];


    /**
     * @var \App\Helpers\ImportRow []
     */
    public $importData = [];

    /**
     * @var array
     */
    public $header = [];

    /**
     * @var string
     */
    private $defaultPath = 'storage/import/';
    /**
     * @var GeocodeService
     */
    private $geocodeService;
    /**
     * @var SyncService
     */
    private $syncService;

    /**
     * ImportService constructor.
     * @param GeocodeService $geocodeService
     * @param SyncService $syncService
     */
    public function __construct(GeocodeService $geocodeService, SyncService $syncService)
    {
        $this->geocodeService = $geocodeService;
        $this->syncService = $syncService;
    }

    /**
     * @param string $fileName
     * @return void
     */
    public function import(string $fileName)
    {
        $this->prepareData();

        $pathToFile = $this->defaultPath . $fileName;
        try {
            $file = fopen($pathToFile, 'r');
        } catch (\Exception $e) {
            Log::notice("Import failed, could not open $pathToFile");
            return;
        }

        $this->header = null;

        while ($row = fgetcsv($file)) {
            if ($this->header === null) {
                $this->header = $row;
                continue;
            }

            $linkedRow = array_combine($this->header, $row);

            $user = $this->mapFromRow($linkedRow);

            if (!$this->isEmailValid($user->email)) {
                $user->valid = false;
                $user->addNote("Invalid email format");
                $this->importData [] = $user;
                continue;
            }

            if ($this->isEmailTaken($user->email)) {
                $user->email = $this->randomizeTakenEmail($user->email);
            }

            $locationAttempt = $this->resolveLocation($user);

            $location = $locationAttempt['location'];

            if (!$location instanceof Location) {
                $user->valid = false;
                $user->addNote("Invalid city");
                $this->importData [] = $user;
                continue;
            }

            $user->location_id = $location->id;
            $user->latitude = $locationAttempt['latitude'];
            $user->longitude = $locationAttempt['longitude'];


            $user->valid = true;
            $user->addNote("To be imported, location: $user->location_id");
            $this->importData [] = $user;
            $this->takenEmails [] = $user->email;
        }

        // save new users, open their stores
        // write users that were unable to be saved to log
        // who had invalid emails or already taken

        //end transaction

        $totalValid = count($this->getValid());

        $this->output("Importing $totalValid");

        foreach ($this->getValid() as $validRow) {
            $this->registerUser($validRow);
        }

        $this->export($fileName);
        
        return;
    }

    public function registerUser(ImportRow $row, Package $package = null, $saveOrigin = true, $syncDashboard = true)
    {
        DB::beginTransaction();

        try {
            $this->output("Importing $row->email => $row->company");

            if ($package == null) {
                $package = $this->lightPackage;
            }
            $user = $this->attemptRegister($row, $package, $saveOrigin);

            if ($saveOrigin && $syncDashboard) {
                $this->syncService->syncDashboardFromOrigin($user);
            }

            DB::commit();

            $this->output("Finished $row->email => $row->company");

            return $user;
        } catch (\Exception $e) {
            $code = $e->getCode();
            $errorMsg = $e->getMessage();
            $this->output("Exception Code: $code, Message: $errorMsg");

            Log::error("Failed to import row Email: $row->email City: $row->location_id");

            $this->output("Error $row->email");

            DB::rollBack();

            // retry, append random number to company name
            // because Store.name has unique constraint
            if ($code == 23000) {
                $this->output("Retrying...");
                $random = rand(100, 999);
                $row->company .= " $random";
                $this->registerUser($row);
            }
        }
    }

    private function export($fileName)
    {
        $pathToFile = $this->defaultPath . date('Y_m_d_His') . "-import-results-report-" . $fileName;
        $file = fopen($pathToFile,"w");

        $headers = $this->header;
        $headers [] = "Note";

        fputcsv($file, $headers);

        foreach ($this->importData as $row)
        {
            fputcsv($file, $this->mapToRow($row));
        }

        fclose($file);
    }

    /**
     * @return ImportRow[]|array
     */
    public function getValid()
    {
        $valid = array_filter($this->importData, function (ImportRow $importRow) {
            return $importRow->valid;
        });

        return $valid;
    }

    /**
     * @return ImportRow[]|array
     */
    public function getInvalid()
    {
        $invalid = array_filter($this->importData, function (ImportRow $importRow) {
            return !$importRow->valid;
        });

        return $invalid;
    }


    /**
     * @param string $email
     * @return bool
     */
    private function isEmailValid(string $email)
    {
        $validator = Validator::make([
            'email' => $email,
        ], [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return false;
        }

        return true;
    }

    /**
     * Takes an mapped array from CSV
     *
     * @param array $row
     * @return ImportRow
     */
    private function mapFromRow(array $row)
    {
        $trimmed = [];

        foreach ($row as $key => $value) {
            $trimmed[$key] = trim($value);
        }

        $row = $trimmed;

        $user = new ImportRow();

        $user->company = $row['Fa.'];
        $user->title = isset($row['AP.']) ? $row['AP.'] : "";
        $user->firstName = isset($row['Vorname']) ? $row['Vorname'] : "";
        $user->lastName = isset($row['Nachname']) ? $row['Nachname'] : "";
        $user->street = $row['Straße'];
        $user->houseNumber = $row['Hausnr.'];
        $user->additionalAddressInfo = $row['Adresszusatz'];
        $user->postalCode = $row['PLZ'];
        $user->city = $row['Ort'];
        $user->phone = isset($row['Telefon']) ? $row['Telefon'] : "";
        $user->email = strtolower($row['Email']);
        $user->brandIdsRaw = $row['Brands'];

        return $user;
    }

    private function mapToRow(ImportRow $user)
    {
        $row = [];

        $row['Fa.'] = $user->company;
        $row['AP'] = $user->title;
        $row['Vorname'] = $user->firstName;
        $row['Nachname'] = $user->lastName;
        $row['Straße'] = $user->street;
        $row['Hausnr.'] = $user->houseNumber;
        $row['Adresszusatz'] = $user->additionalAddressInfo;
        $row['PLZ'] = $user->postalCode;
        $row['Ort'] = $user->city;
        $row['Telefon'] = $user->phone;
        $row['Email'] = $user->email;
        $row['Note'] = $user->note;

        return $row;
    }

    private function mapToCSVRow(ImportRow $user)
    {
        $data = [];

        $data []= $user->company;
        $data []= $user->title;
        $data []= $user->firstName;
        $data []= $user->lastName;
        $data []= $user->street;
        $data []= $user->houseNumber;
        $data []= $user->additionalAddressInfo;
        $data []= $user->postalCode;
        $data []= $user->city;
        $data []= $user->phone;
        $data []= $user->email;
        $data []= $user->note;

        $csv = '';
        foreach($data as $item) {
            $csv .= implode(',', $item) . "\n";
        }

        return $csv;
    }

    /**
     * Makes sure all 4 Packages are in database
     *
     * @return void
     */
    private function ensurePackagesArePresent()
    {
        Artisan::call('db:seed', [
            '--class' => 'PackagesTableSeeder',
            '--force' => true,
        ]);
    }


    /**
     * @return string []
     */
    private function loadTakenEmails()
    {
        $emails = [];

        foreach ($this->users as $user) {
            array_push($emails, strtolower($user->email));
        }

        return $emails;
    }


    /**
     * Load Packages and existing users, locations (cities)
     * Map existing users' emails into a property to keep track of taken emails
     */
    private function prepareData()
    {
        $this->lightPackage = Package::where('name', Package::LIGHT)->firstOrFail();
        $this->users = User::all();
        $this->takenEmails = $this->loadTakenEmails();
    }

    /**
     * @param string $email
     * @return bool
     */
    private function isEmailTaken(string $email): bool
    {
        return in_array(strtolower($email), $this->takenEmails);
    }


    /**
     * @param ImportRow $row
     * @param Package $package
     * @param bool $saveOrigin
     * @return User
     */
    private function attemptRegister(ImportRow $row, Package $package, $saveOrigin = true)
    {
        $isLightStore = false;

        if ($package->name === Package::LIGHT) {
            $isLightStore = true;
        }

        $store = new Store();
        $store->store_name = $row->company;
        $store->status = true;
        $store->user_email = $row->email;
        $store->location_id = $row->location_id;
        $store->is_light = $isLightStore;
        $store->latitude = $row->latitude;
        $store->longitude = $row->longitude;
        $store->uses_coordinates = true;
        $store->save();


        $brandIds = $row->getBrandIds();

        if (count($brandIds) > 0) {
            $store->manufacturers()->sync($brandIds);
            $store->save();
        }

        $user = new User();
        $user->name = trim("$row->firstName $row->lastName");
        $user->email = $row->email;
        $user->confirmed = true;
        $user->password = bcrypt('topditop');
        $user->store_id = $store->id;
        $user->save();


        $profile = new Profile();
        $profile->package_id = $package->id;
        $profile->store_id = $store->id;
        $profile->save();

        if ($saveOrigin) {
            $origin = new Origin();
            $origin->company = $row->company;
            $origin->title = $row->title;
            $origin->first_name = $row->firstName;
            $origin->last_name = $row->lastName;
            $origin->street = $row->street;
            $origin->email = $row->email;
            $origin->house_number = $row->houseNumber;
            $origin->additional_address_info = $row->additionalAddressInfo;
            $origin->postal_code = $row->postalCode;
            $origin->city = $row->city;
            $origin->phone = $row->phone;
            $origin->user()->associate($user);
            $origin->save();
        }

        $row->addNote("Imported User $user->id $user->email, Store $store->id");

        return $user;
    }



    /**
     * @param ImportRow $user
     * @return array
     */
    private function resolveLocation(ImportRow $user)
    {
        $address = "$user->street+$user->houseNumber+$user->postalCode+$user->city";
        $this->output("Searching for: $address");
        $result_de = $this->geocodeService->geocode($address);

        if (!$result_de) {
            $this->output("Google Maps could not determine the city for $address");
            return [
                'location' => null,
                'latitude' => null,
                'longitude' => null,
            ];
        }

        $long_name_de = $this->geocodeService->extractCityLongName($result_de);

        $result_en = $this->geocodeService->geocode($long_name_de, 'en');
        $long_name_en = $this->geocodeService->extractCityLongName($result_en);

        $existingLocation = Location::where('key', str_slug($long_name_de))->first();

        $latitude = $this->geocodeService->extractLatitude($result_de);
        $longitude = $this->geocodeService->extractLongitude($result_de);

        if ($existingLocation instanceof Location) {
            $this->output("Location already exists: $existingLocation->long_name");
            return [
                'location' => $existingLocation,
                'latitude' => $latitude,
                'longitude' => $longitude,
            ];
        }

        $newLocation = $this->createNewLocation($long_name_de, $long_name_en, $latitude, $longitude);

        $this->output("Location added: $newLocation->long_name");
        return [
            'location' => $newLocation,
            'latitude' => $latitude,
            'longitude' => $longitude,
        ];
    }

    private function createNewLocation(string $long_name_de, string $long_name_en, float $latitude, float $longitude)
    {
        $location = new Location();
        $location->key = str_slug($long_name_de);
        $location->long_name = $long_name_de;
        $location->latitude = $latitude;
        $location->longitude = $longitude;
        $location->translateOrNew('de')->name = $long_name_de;
        $location->translateOrNew('en')->name = $long_name_en;
        $location->save();

        return $location;
    }

    /**
     * @param string $email
     * @return mixed
     */
    private function randomizeTakenEmail($email)
    {
        $replaceWith = '.topditop.' . random_int(1000, 9999) . '@';

        return str_replace('@', $replaceWith, $email);
    }


}