<?php

namespace App\Console\Commands;

use App\Services\GeocodeService;
use App\Services\LocationService;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;

class TopImportCitiesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'top:import:cities {filename}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import cities from csv in src/storage/import';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @param GeocodeService $geocodeService
     * @param LocationService $locationService
     * @return mixed
     */
    public function handle(GeocodeService $geocodeService, LocationService $locationService)
    {
        $filename = $this->argument('filename');

        $exists = Storage::disk('storage')->exists("import/$filename");

        if (!$exists) {
            $this->error("File $filename does not exists");
            return;
        }

        //load the CSV document from a file path
//        $csv = Reader::createFromPath('/path/to/your/csv/file.csv', 'r');
        $csv = Reader::createFromPath(storage_path("import/$filename"), 'r');
        $rows = $csv->fetchAll();

        $collection = new Collection($rows);

        $collection->each(function ($item, $index) use ($geocodeService, $locationService) {
            if ($index === 0) {
                return;
            }
            $city = trim($item[1]);
            $plz = trim($item[0]);

            if (!(strlen($city) > 0 && strlen($plz) > 0)) {
                $this->info("Skipping invalid row $index");
            }

            $term = "$plz $city";
            $termDE = "$term Österreich";
            $termEN = "$term Austria";

            $resultDE = null;
            $resultEN = null;
            try {
                $resultDE = $geocodeService->geocode($termDE);
                $resultEN = $geocodeService->geocode($termEN, "en");
            } catch (\Exception $e) {
                $this->error("Failed Google Lookup $term", $e->getMessage());
            }

            if ($resultDE == null) {
                $this->error("Lookup DE failed for row: $index, term: $term");
                return;
            }
            if ($resultEN == null) {
                $this->error("Lookup EN failed for row: $index, $term");
                return;
            }

            $longnameDE = null;
            $longnameEN = null;
            $latitude = null;
            $longitude = null;

            try {
                $longnameDE = $geocodeService->extractCityLongName($resultDE);
                $longnameEN = $geocodeService->extractCityLongName($resultEN);
                $latitude = $geocodeService->extractLatitude($resultDE);
                $longitude = $geocodeService->extractLongitude($resultDE);
            } catch (\Exception $exception) {
                $this->error("Unable to determine long city name for term: $term");
                return;
            }

            $key = str_slug($longnameDE);
            $available = $locationService->isKeyAvailable($key);
            if ($available) {
                $created = $locationService->create($longnameDE, $longnameEN, $latitude, $longitude);
                $this->info("Created: $created->id $created->long_name - from row: $index, City: $city, PLZ: $plz");
            } else {
                $this->info("Already exists by key $key - Row: $index, City: $city, PLZ: $plz");
            }
        });

    }
}
