<?php

namespace App\Services;

use App\Location;

class LocationService
{
    /**
     * @var GeocodeService
     */
    private $geocodeService;

    /**
     * LocationService constructor.
     * @param GeocodeService $geocodeService
     */
    public function __construct(GeocodeService $geocodeService)
    {
        $this->geocodeService = $geocodeService;
    }

    public function validateExistingLocationsOnGoogle()
    {
        $locations = Location::whereNull('long_name')->get();

        foreach ($locations as $location) {
            $this->updateLocation($location);
        }
    }

    private function updateLocation(Location $location)
    {
        $response = $this->geocodeService->geocode($location->key);

        if (!$response) {
            return;
        }

        $long_name = $this->geocodeService->extractCityLongName($response);

        $location->long_name = $long_name;
        $location->key = str_slug($long_name);
        $location->save();
    }
}