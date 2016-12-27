<?php

use Illuminate\Database\Seeder;

class FieldsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement(
            "INSERT INTO `fields` (`key`, `name`, `values`, `created_at`, `updated_at`, `fieldtype_id`) VALUES
    ('address', 'Store Address', '', '2016-10-26 08:32:52', '2016-10-31 13:59:44', 5),
                ('phone', 'Phone Numebr', '', '2016-10-26 08:33:16', '2016-10-31 13:59:44', 5),
                ('map_location', 'Map Location', '', '2016-10-26 08:33:53', '2016-10-31 13:59:50', 5),
                ('country', 'Country', 'Austria, Serbia, US, UK', '2016-10-26 08:34:09', '2016-10-31 13:59:50', 1),
                ('store_type', 'Store Type', 'New, Old', '2016-10-26 08:34:23', '2016-10-31 13:59:56', 1),
                ('description', 'Description', '', '2016-10-26 08:34:36', '2016-10-31 14:00:02', 6),
                ('quote', 'Quote', '', '2016-10-31 09:17:00', '2016-10-31 14:00:02', 5),
                ('sharability', 'Available for share?', '', '2016-11-01 10:15:53', '2016-11-01 10:16:12', 3),
                ('onestopshop', 'OneStopShop', 'Interior Planning, Sofas Beds, Tables Cupboards, Kitchen Bathroom, Kids room, Floor, Office, Accessoires, Dekor', '2016-11-01 11:15:31', '2016-11-01 11:15:41', 4);"
        );
    }
}
