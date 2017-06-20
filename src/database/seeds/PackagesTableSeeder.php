<?php

use App\Package;
use Illuminate\Database\Seeder;

class PackagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $highest = Package::where('name', Package::HIGHEST)->first();
        if (!$highest) {
            Package::create(['name' => Package::HIGHEST]);
        }

        $middle = Package::where('name', Package::MIDDLE)->first();
        if (!$middle) {
            Package::create(['name' => Package::MIDDLE]);
        }

        $lowest = Package::where('name', Package::LOWEST)->first();
        if (!$lowest) {
            Package::create(['name' => Package::LOWEST]);
        }

        $light = Package::where('name', Package::LIGHT)->first();
        if (!$light) {
            Package::create(['name' => Package::LIGHT]);
        }
    }
}
