<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{

    use \Dimsav\Translatable\Translatable;

    public $translatedAttributes = ['name'];

    protected $fillable = ['name', 'key', 'latitude', 'longitude'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function stores()
    {
        return $this->hasMany('App\Store'); // or Profile::class
    }

    public function numberOfStores() {
        return count($this->stores()->get());
    }
}
