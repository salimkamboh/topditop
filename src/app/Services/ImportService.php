<?php


namespace App\Services;


use App\Helpers\ImportRow;
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
                $this->importData [] = $user;
                continue;
            }

            $user->valid = true;
            $this->importData [] = $user;
            $this->takenEmails [] = $user->email;
        }

        // save new users, open their stores
        // write users that were unable to be saved to log
        // who had invalid emails or already taken

        //end transaction

        return;
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

        if (in_array(strtolower($email), $this->takenEmails)) {
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
     * @return \App\User[]
     */
    private function loadUsers()
    {
        return User::all();
    }

    /**
     * Load Packages and existing users
     * Map existing users' emails into a property to keep track of taken emails
     */
    private function prepareData()
    {
        $this->lightPackage = $this->loadLightPackage();
        $this->users = $this->loadUsers();
        $this->takenEmails = $this->loadTakenEmails();
    }
}