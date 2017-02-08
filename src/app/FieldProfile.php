<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class FieldProfile extends Model
{

    use \Dimsav\Translatable\Translatable;

    public $translatedAttributes = ['selected'];

    protected $fillable = ['selected'];

    protected $table = 'field_profile';

}
