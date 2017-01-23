<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    protected $fillable = [
        'title',
        'image_url',
        'slot1_store_id',
        'slot1_width',
        'slot1_valid_until',

        'slot2_store_id',
        'slot2_width',
        'slot2_valid_until',

        'slot3_store_id',
        'slot3_width',
        'slot3_valid_until',

        'slot4_store_id',
        'slot4_width',
        'slot4_valid_until',

        'slot5_store_id',
        'slot5_width',
        'slot5_valid_until',

        'base64'
    ];

    public function getImageUrl()
    {
        #/var/www/html/topditop2/magento1931/media/Foundcenter logo.png
        //return str_replace('/var/www/html/', 'http://138.201.246.165/', $this->image_url);
    }
}