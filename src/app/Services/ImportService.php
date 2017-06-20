<?php


namespace App\Services;


use App\Package;
use App\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

class ImportService
{

    protected $lightPackage;
    protected $users;
    private $defaultPath = 'storage/import/';

    /**
     * ImportService constructor.
     */
    public function __construct()
    {
        $this->loadLightPackage();
        $this->users = User::all();
    }

    public function import(string $fileName)
    {
        $fileToImport = $this->defaultPath . $fileName;
        try {
            $file = fopen($fileToImport, 'r');
        } catch (\Exception $e) {
            Log::notice('Import failed, could not open ' . $fileToImport);
            return;
        }

        //start transaction

        $all_rows = array();
        $header = null;
        while ($row = fgetcsv($file)) {
            if ($header === null) {
                $header = $row;
                continue;
            }
            $all_rows[] = array_combine($header, $row);
        }

        print_r($all_rows);

        // save new users, open their stores
        // write users that were unable to be saved to log
        // who had invalid emails or already taken

        //end transaction
    }

    private function ensurePackagesArePresent()
    {
        Artisan::call('db:seed', [
            '--class' => 'PackagesTableSeeder',
            '--force' => true,
        ]);
    }

    private function loadLightPackage()
    {
        try {
            $this->lightPackage = Package::where('name', Package::LIGHT)->firstOrFail();
        } catch (\Exception $e) {
            $this->ensurePackagesArePresent();
            $this->lightPackage = Package::where('name', Package::LIGHT)->first();
        }
    }
}