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
    public $lightPackage;

    /**
     * @var \App\User []
     */
    public $users;

    /**
     * @var string []
     */
    public $takenEmails;


    /**
     * @var \App\Helpers\ImportRow []
     */
    public $valid;

    /**
     * @var \App\Helpers\ImportRow []
     */
    public $invalid;

    private $defaultPath = 'storage/import/';

    /**
     * ImportService constructor.
     */
    public function __construct()
    {
        $this->lightPackage = $this->loadLightPackage();
        $this->users = $this->loadUsers();
        $this->takenEmails = $this->loadTakenEmails();
    }

    public function import(string $fileName)
    {
        $pathToFile = $this->defaultPath . $fileName;
        try {
            $file = fopen($pathToFile, 'r');
        } catch (\Exception $e) {
            Log::notice("Import failed, could not open $pathToFile");
            return;
        }

        //start transaction

        $valid = [];
        $invalid = [];

        $header = null;
        while ($row = fgetcsv($file)) {
            if ($header === null) {
                $header = $row;
                continue;
            }

            $linkedRow = array_combine($header, $row);

            $user = $this->mapFromRow($linkedRow);

            if (!$this->isEmailValidAndAvailable($user->email)) {
                $invalid [] = $user;
                continue;
            }

            $valid [] = $user;
            $this->takenEmails [] = $user->email;
        }

//        print_r("VALID DATA IS");
//        print_r($valid);
//        print_r("INVALID DATA IS");
//        print_r($invalid);

        $this->valid = $valid;
        $this->invalid = $invalid;
        // save new users, open their stores
        // write users that were unable to be saved to log
        // who had invalid emails or already taken

        //end transaction
    }

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

    private function loadUsers()
    {
        return User::all();
    }
}