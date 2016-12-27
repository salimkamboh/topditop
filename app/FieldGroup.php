<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FieldGroup extends Model
{
    use \Dimsav\Translatable\Translatable;

    public $translatedAttributes = ['name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function packages() {
        return $this->belongsToMany('App\Package');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fields() {
        return $this->hasMany('App\Field', 'field_group_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function panels()
    {
        return $this->belongsToMany('App\Panel');
    }
}