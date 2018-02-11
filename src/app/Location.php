<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Location
 *
 * @property int $id
 * @property string $key
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property float $latitude
 * @property float $longitude
 * @property bool $online
 * @property string $long_name
 * @property bool $is_featured
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Store[] $stores
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\LocationTranslation[] $translations
 * @method static \Illuminate\Database\Query\Builder|\App\Location featured()
 * @method static \Illuminate\Database\Query\Builder|\App\Location listsTranslations($translationField)
 * @method static \Illuminate\Database\Query\Builder|\App\Location notTranslatedIn($locale = null)
 * @method static \Illuminate\Database\Query\Builder|\App\Location translated()
 * @method static \Illuminate\Database\Query\Builder|\App\Location translatedIn($locale = null)
 * @method static \Illuminate\Database\Query\Builder|\App\Location whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Location whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Location whereIsFeatured($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Location whereKey($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Location whereLatitude($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Location whereLongName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Location whereLongitude($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Location whereOnline($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Location whereTranslation($key, $value, $locale = null)
 * @method static \Illuminate\Database\Query\Builder|\App\Location whereTranslationLike($key, $value, $locale = null)
 * @method static \Illuminate\Database\Query\Builder|\App\Location whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Location withTranslation()
 * @mixin \Eloquent
 */
class Location extends Model
{

    use \Dimsav\Translatable\Translatable;

    public $translatedAttributes = ['name'];

    protected $fillable = ['name', 'latitude', 'longitude'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function stores()
    {
        return $this->hasMany('App\Store'); // or Profile::class
    }

    public function hasStores()
    {
        return count($this->stores) != 0;
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', 1);
    }

    public function scopePopular($query)
    {
        // Locations that have 10 or more stores
        return $query->with('stores')->withCount('stores')->has('stores', '>=', 10);
    }
}
