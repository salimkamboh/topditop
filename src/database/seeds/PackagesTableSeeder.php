<?php

use App\Package;
use App\Panel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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

        $this->ensureLightPackagePanelsAndFieldGroupsAndTranslationsExist();
    }

    private function ensureLightPackagePanelsAndFieldGroupsAndTranslationsExist()
    {
        DB::transaction(function () {
            $lightPackage = Package::where('name', Package::LIGHT)->firstOrFail();

            $lowestPackage = Package::where('name', Package::LOWEST)->firstOrFail();
            $lowestPackagePanels = $lowestPackage->panels;

            foreach ($lowestPackagePanels as $existingLowestPanel) {
                $newLightPanel = new Panel();
                $newLightPanel->key = "light-" . $existingLowestPanel->key;
                $newLightPanel->package_id = $lightPackage->id;
                $newLightPanel->save();

                $fieldGroupIdsOfExistingPanel = $existingLowestPanel->fieldGroups->pluck('id')->all();

                $newLightPanel->fieldGroups()->sync($fieldGroupIdsOfExistingPanel);

                $newLightPanel->translateOrNew('de')->name = $existingLowestPanel->translate('de')->name;
                $newLightPanel->translateOrNew('en')->name = $existingLowestPanel->translate('en')->name;

                $newLightPanel->save();
            }
        });
    }
}
