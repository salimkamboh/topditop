<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public static $rules = [
        'file' => 'required|mimes:png,gif,jpeg,jpg,bmp'
    ];

    public static $messages = [
        'file.mimes' => 'Uploaded file is not in image format',
        'file.required' => 'Image is required'
    ];

    /**
     * Get the store that owns the image.
     */
    public function store()
    {
        return $this->hasOne('App\Store');
    }

    public function products()
    {
        return $this->belongsToMany('App\Product');
    }

    public function references()
    {
        return $this->belongsToMany('App\Reference');
    }

    public function thumbnails()
    {
        return $this->belongsToMany('App\Thumbnail')->withTimestamps();
    }

    public function mainThumbImage()
    {
        return str_replace('full_size', 'icon_size', $this->url);
    }

    public function getImageByThumb($slug)
    {
        return str_replace('full_size', 'icon_size/' . $slug, $this->url);
    }

    public function getReferenceId()
    {
        return $this->references()->first()->id;
    }

    public function getProductId()
    {
        return $this->products()->first()->id;
    }
}