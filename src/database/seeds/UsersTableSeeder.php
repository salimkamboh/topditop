<?php

use Illuminate\Database\Seeder;
use App\Store;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $store = Store::find(1);
        DB::table('users')->insert([
            'name' => 'Slavisa Perisic',
            'email' => 'slavishaofficial@gmail.com',
            'password' => bcrypt('topditop'),
            'store_id' => $store->id
        ]);
    }
}
