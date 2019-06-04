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
        $response_de = $this->geocodeService->geocode($location->key);

        if (!$response_de) {
            return;
        }

        $long_name_de = $this->geocodeService->extractCityLongName($response_de);

        $response_en = $this->geocodeService->geocode($location->key, 'en');
        $long_name_en = $this->geocodeService->extractCityLongName($response_en);

        $location->long_name = $long_name_de;
        $location->key = str_slug($long_name_de);
        $location->translateOrNew('de')->name = $long_name_de;
        $location->translateOrNew('en')->name = $long_name_en;
        $location->is_featured = true;
        $location->save();
    }

    public function isKeyAvailable(string $key)
    {
        $location = Location::where(['key' => $key])->first();

        if ($location instanceof Location) {
            return false;
        }

        return true;
    }

    public function create(string $long_name_de, string $long_name_en, float $latitude, float $longitude)
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
}