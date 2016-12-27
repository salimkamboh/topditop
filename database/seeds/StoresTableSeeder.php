<?php

use Illuminate\Database\Seeder;

class StoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stores')->insert([
            'store_name' => str_random(10),
            'user_email' => 'slavishaofficial@gmail.com',
            'mag_store_id' => 1,
            'mag_cat_id' => 5,
        ]);
    }
}