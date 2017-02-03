<?php

namespace App\Entity\Location;

use App\Location;
use App\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class Repository
{
    /**
     * @param Request $request
     * @return Location
     */
    public function saveNew(Request $request)
    {
        $locale = App::getLocale();
        $location = new Location();
        $location->key = $request->key;
        $location->latitude = $request->latitude;
        $location->longitude = $request->longitude;
        $location->translateOrNew($locale)->name = $request->name;
        $location->save();
        return $location;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll()
    {
        return Location::withTranslation()->get();
    }

    public function listAll()
    {
        $locations = Location::all();

        $locationsObjects = array();
        foreach ($locations as $location) {
            $locationsObject = array();

            $translate = $location->translate();

            $locationsObject["id"] = $location->id;
            $locationsObject["key"] = $location->key;
            $locationsObject["name"] = $translate['name'];

            $locationsObject["lat"] = (double)$location->latitude;
            $locationsObject["lng"] = (double)$location->longitude;

            /** @var Store $store */
            foreach ($location->stores as $store) {

                $storeSettings = $store->getStoreData();

                $locationsObject["stores"][] = array(
                    "store_name" => $store->store_name,
                    "latitude" => $storeSettings['store_latitude'],
                    "longitude" => $storeSettings['store_longitude'],
                );
            }
            $locationsObjects[] = $locationsObject;
        }

        echo json_encode($locationsObjects);
    }

    /**
     * @param Location $location
     * @return mixed
     */
    public function get(Location $location)
    {
        return Location::find($location->id);
    }

    /**
     * @param Request $request
     * @param Location $location
     * @return Location
     */
    public function update(Request $request, Location $location)
    {
        $locale = App::getLocale();
        $location->longitude = $request->longitude;
        $location->latitude = $request->latitude;
        $location->key = $request->key;

        $location->translateOrNew($locale)->name = $request->name;

        $location->save();
        return $location;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function listEnhancedLocations()
    {

        $locations = Location::all();

        $locationsObjects = array();
        foreach ($locations as $location) {
            $locationsObject = array();

            $translate = $location->translate();

            $locationsObject["id"] = $location->id;
            $locationsObject["key"] = $location->key;
            $locationsObject["name"] = $translate['name'];
            $locationsObject["numStores"] = count($location->stores);

            $locationsObject["lat"] = (double)$location->latitude;
            $locationsObject["lng"] = (double)$location->longitude;

            /** @var Store $store */
            foreach ($location->stores as $store) {
                $storeSettings = $store->getStoreData();
                $locationsObject["stores"][] = array(
                    "store_id" => $store->id,
                    "store_name" => $store->store_name,
                    "latitude" => $storeSettings['store_latitude'],
                    "longitude" => $storeSettings['store_longitude'],
                    "img" => $store->getStoreLogo(),
                    "numproducts" => $store->getNumberOfProducts(),
                    "numreferences" => $store->getNumberOfReferences(),
                );
            }
            $locationsObjects[] = $locationsObject;
        }

        return $locationsObjects;
    }

    /**
     * @param Location $location
     */
    public function delete(Location $location)
    {
        $location->delete();
    }
}