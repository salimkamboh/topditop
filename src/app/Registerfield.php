<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registerfield extends Model
{
    protected $fillable = ['key', 'name', 'values', 'fieldlocation'];

    public function users()
    {
        return $this->belongsToMany('App\User')->withPivot('valueEntered')->withTimestamps();
    }
}
