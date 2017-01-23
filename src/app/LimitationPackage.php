<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LimitationPackage extends Model
{
    protected $fillable = ['value'];

    protected $table = 'limitation_package';
}
