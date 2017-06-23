<?php

namespace App\Services;

use App\Helpers\ImportRow;
use App\Location;
use App\Package;
use App\Profile;
use App\Store;
use App\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ImportService
{
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
     * @var \App\Location []
     */
    public $locations = [];

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
     * ImportService constructor.
     */
    public function __construct()
    {
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
                $user->valid = false;
                $user->addNote("Invalid email taken");
                $this->importData [] = $user;
                continue;
            }

            if (!$this->isValidCity($user->city, $user)) {
                $user->valid = false;
                $user->addNote("Invalid city");
                $this->importData [] = $user;
                continue;
            }

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

    public function registerUser(ImportRow $row)
    {
        DB::beginTransaction();

        try {
            $this->output("Importing $row->email => $row->company");

            $this->attemptRegister($row);

            DB::commit();

            $this->output("Finished $row->email => $row->company");
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
        $pathToFile = $this->defaultPath . date('Y_m_d_His') . "-" . $fileName;
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
            $trimmed[$key] = $value;
        }

        $row = $trimmed;

        $user = new ImportRow();

        $user->company = $row['Fa.'];
        $user->title = $row['AP'];
        $user->firstName = $row['Vorname'];
        $user->lastName = $row['Nachname'];
        $user->street = $row['Straße'];
        $user->houseNumber = $row['Hausnr.'];
        $user->additionalAddressInfo = $row['Adresszusatz'];
        $user->postalCode = $row['PLZ'];
        $user->city = $row['Ort'];
        $user->phone = $row['Telefon'];
        $user->email = strtolower($row['Email']);
        $user->fax = $row['Fax'];
        $user->website = strtolower($row['Website']);
//        $user->mail = strtolower($row['Mail']);

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
        $row['Fax'] = $user->fax;
        $row['Website'] = $user->website;
//        $row['Mail'] = $user->mail;
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
        $data []= $user->fax;
        $data []= $user->website;
//        $data []= $user->mail;
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
     * @return \App\Package
     */
    private function loadLightPackage()
    {
        $package = null;

        try {
            $package = Package::where('name', Package::LIGHT)->firstOrFail();
        } catch (\Exception $e) {
            $this->ensurePackagesArePresent();
            $package = Package::where('name', Package::LIGHT)->first();
        }

        return $package;
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

    private function isValidCity($location, ImportRow &$row)
    {
        $clean = str_slug($location);

        // Currently supported Locations by key:
        // munich, düsseldorf, hamburg, vienna

        if (str_is('muenchen*', $clean)) {
            $row->location_id = $this->getLocationId('*munich');
            return true;
        }
        if (str_is('*duesseldorf*', $clean)) {
            $row->location_id = $this->getLocationId('*seldorf*');
            return true;
        }
        if (str_is('*hamburg*', $clean)) {
            $row->location_id = $this->getLocationId('*hamburg');
            return true;
        }
        if (str_is('*vienna*', $clean)) {
            $row->location_id = $this->getLocationId('*vienna*');
            return true;
        }

        return false;
    }

    private function getLocationId(string $partialName)
    {
        foreach ($this->locations as $location) {
            if (str_is($partialName, $location->key)) {
                return $location->id;
            }
        }

        return self::INVALID_LOCATION_ID;
    }

    /**
     * Load Packages and existing users, locations (cities)
     * Map existing users' emails into a property to keep track of taken emails
     */
    private function prepareData()
    {
        $this->lightPackage = $this->loadLightPackage();
        $this->users = User::all();
        $this->takenEmails = $this->loadTakenEmails();
        $this->locations = Location::all();
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
     */
    private function attemptRegister(ImportRow $row)
    {
        $store = new Store();
        $store->store_name = $row->company;
        $store->status = true;
        $store->user_email = $row->email;
        $store->location_id = $row->location_id;
        $store->is_light = true;
        $store->save();

        $user = new User();
        $user->name = trim("$row->firstName $row->lastName");
        $user->email = $row->email;
        $user->confirmed = true;
        $user->password = bcrypt('topditop');
        $user->store_id = $store->id;
        $user->save();


        $profile = new Profile();
        $profile->package_id = $this->lightPackage->id;
        $profile->store_id = $store->id;
        $profile->save();

        $row->addNote("Imported User $user->id $user->email, Store $store->id");
    }

    private function output(string $message)
    {
        print_r($message . PHP_EOL);
    }
}