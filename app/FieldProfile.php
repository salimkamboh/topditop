<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

class FieldProfile extends Model
{

    use \Dimsav\Translatable\Translatable;

    public $translatedAttributes = ['selected'];

    protected $fillable = ['selected'];

    protected $table = 'field_profile';

}
