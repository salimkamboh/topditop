<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MiscConfig;

class MiscConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $configs = [
            [
                "key" => "take",
                "value" => 1,
            ],
            [
                "key" => "debug",
                "value" => 1,
            ],
            [
                "key" => "edenapi_debug_key",
                "value" => 1,
            ],
        ];
        foreach ($configs as $config) {
            MiscConfig::updateOrCreate($config, []);
        }
    }
}
