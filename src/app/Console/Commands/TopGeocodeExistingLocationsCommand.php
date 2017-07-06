<?php

namespace App\Console\Commands;

use App\Services\GeocodeService;
use App\Services\LocationService;
use function Clue\StreamFilter\fun;
use function foo\func;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class TopGeocodeExistingLocationsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'top:geocode:locations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update existing Location.long_name by key lookup on Google Maps';

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
     * @param LocationService $locationService
     * @return mixed
     */
    public function handle(LocationService $locationService)
    {
        DB::transaction(function () use ($locationService) {
            $locationService->validateExistingLocationsOnGoogle();
        });
    }
}
