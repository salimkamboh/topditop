<?php

namespace App\Services;

use App\Manufacturer;
use App\Store;
use Illuminate\Support\Facades\DB;

class StoreService
{

    public function findNearestStore(float $latitude, $longitude)
    {
        $stores = $this->findNearbyStores($latitude, $longitude, 1);

        return count($stores) === 0 ? null : $stores[0];
    }

    public function findNearbyStores(float $latitude, $longitude, int $limit = 10)
    {
        $sortedResults = DB::select("
          SELECT s.id, s.latitude, s.longitude, ( 6371 * acos( cos( radians({$latitude}) ) * 
          cos( radians( s.latitude ) ) * cos( radians( s.longitude ) - radians({$longitude}) ) + 
          sin( radians({$latitude}) ) * sin( radians( s.latitude ) ) ) ) AS distance 
          FROM stores as s 
          ORDER BY distance LIMIT {$limit}");

        $sortedStoreIds = collect($sortedResults)->pluck('id')->toArray();

        $unsortedStores = Store::find($sortedStoreIds);

        $sortedStores = [];

        foreach ($sortedStoreIds as $id) {
            $sortedStores [] = $unsortedStores->find($id);
        }

        return $sortedStores;
    }

    public function findNearestStoreForManufacturer(int $manufacturerId, float $latitude, $longitude, int $limit = 10) {
        $stores = $this->findNearbyStoresForManufacturer($manufacturerId, $latitude, $longitude, 1);

        return count($stores) === 0 ? null : $stores[0];
    }

    public function findNearbyStoresForManufacturer(int $manufacturerId, float $latitude, $longitude, int $limit = 10)
    {
        $resultsSortedByDistance = DB::select("
          SELECT s.id, s.latitude, s.longitude, ( 6371 * acos( cos( radians({$latitude}) ) * 
          cos( radians( s.latitude ) ) * cos( radians( s.longitude ) - radians({$longitude}) ) + 
          sin( radians({$latitude}) ) * sin( radians( s.latitude ) ) ) ) AS distance 
          FROM stores as s
          WHERE s.id in (
            SELECT store_id from manufacturer_store where manufacturer_id = {$manufacturerId}
          ) 
          ORDER BY distance LIMIT {$limit}
        ");

        $storeIdsSortedByDistance = collect($resultsSortedByDistance)->pluck('id')->toArray();

        $storesSortedById = Store::find($storeIdsSortedByDistance);

        $storesSortedByDistance = [];

        foreach ($storeIdsSortedByDistance as $storeId) {
            $storesSortedByDistance []= $storesSortedById->find($storeId);
        }

        return $storesSortedByDistance;
    }
}