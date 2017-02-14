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
        return url('images' .$this->image_url);
    }


    private function cutAbsolutePath()
    {
        if (! $this->image_url) {
            return;
        }
        $messyRelativePath = parse_url($this->image_url, PHP_URL_PATH);
        $cleanRelativePath = str_replace('/topditop/images/', '/images/', $messyRelativePath);
        $cleanRelativePath = str_replace('/images/', '/', $cleanRelativePath);
        $this->image_url = $cleanRelativePath;
        $this->save();
    }

    static function replaceAllImagesPath()
    {
        $slides = Slide::all();

        foreach ($slides as $slide) {
            $slide->cutAbsolutePath();
        }
    }
}
