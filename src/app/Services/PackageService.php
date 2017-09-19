<?php

namespace App\Services;

use App\Package;
use App\Store;
use Illuminate\Support\Facades\DB;

class PackageService
{
    /**
     * @param Store $store
     * @param Package $package
     * @return Store
     * @throws \Exception
     */
    public function upgrade(Store $store, Package $package)
    {
        if ($package->name !== Package::HIGHEST && $package->name !== Package::MIDDLE && $package->name !== Package::LOWEST) {
            throw new \Exception("Must upgrade to a payed package");
        }

        if ($store instanceof Store && !$store->isLight()) {
            throw new \Exception("Only light store can be upgraded, this is" . $store->package_name());
        }

        $store->is_light = false;
        $store->profile->package()->associate($package);

        DB::transaction(function () use ($store) {
            $store->profile->save();
            $store->save();
        });

        return $store;
    }
}