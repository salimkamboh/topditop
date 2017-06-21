<?php


namespace App\Services;


use App\Helpers\ImportRow;
use App\Location;
use App\Package;
use App\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ImportService
{

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

            if (!$this->isEmailValidAndAvailable($user->email)) {
                $user->valid = false;
                $user->note = "Email is missing, taken or invalid";
                $this->importData [] = $user;
                continue;
            }

            $user->valid = true;
            $user->note = "Imported";
            $this->importData [] = $user;
            $this->takenEmails [] = $user->email;
        }

        // save new users, open their stores
        // write users that were unable to be saved to log
        // who had invalid emails or already taken

        //end transaction

        $this->export($fileName);
        
        return;
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
    private function isEmailValidAndAvailable(string $email)
    {
        $validator = Validator::make([
            'email' => $email,
        ], [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return false;
        }

        if ($this->isEmailTaken($email)) {
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
        $user->mail = strtolower($row['Mail']);

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
        $row['Mail'] = $user->mail;
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
        $data []= $user->mail;
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
}