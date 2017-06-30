<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\LocationTranslation
 *
 * @property int $id
 * @property int $location_id
 * @property string $locale
 * @property string $name
 * @method static \Illuminate\Database\Query\Builder|\App\LocationTranslation whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\LocationTranslation whereLocale($value)
 * @method static \Illuminate\Database\Query\Builder|\App\LocationTranslation whereLocationId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\LocationTranslation whereName($value)
 * @mixin \Eloquent
 */
class LocationTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['name'];

}