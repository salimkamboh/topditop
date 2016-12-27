<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thumbnail extends Model
{
    protected $fillable = ['name', 'width', 'height', 'crop'];

    public function images()
    {
        return $this->belongsToMany('App\Image')->withTimestamps();
    }
}
