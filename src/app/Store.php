<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Store
 *
 * @property int $id
 * @property string $store_name
 * @property int $mag_store_id
 * @property int $mag_cat_id
 * @property string $user_email
 * @property bool $status
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $image_id
 * @property int $location_id
 * @property string $cover_url
 * @property-read \App\Image $image
 * @property-read \App\Location $location
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Manufacturer[] $manufacturers
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Product[] $products
 * @property-read \App\Profile $profile
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Reference[] $references
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Query\Builder|\App\Store active()
 * @method static \Illuminate\Database\Query\Builder|\App\Store whereCoverUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Store whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Store whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Store whereImageId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Store whereLocationId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Store whereMagCatId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Store whereMagStoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Store whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Store whereStoreName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Store whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Store whereUserEmail($value)
 * @mixin \Eloquent
 * @property bool $is_light
 * @method static \Illuminate\Database\Query\Builder|\App\Store whereIsLight($value)
 * @property float $latitude
 * @property float $longitude
 * @property bool $uses_coordinates
 * @method static \Illuminate\Database\Query\Builder|\App\Store whereLatitude($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Store whereLongitude($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Store whereUsesCoordinates($value)
 */
class Store extends Model
{

    const PACKAGE_1 = Package::LOWEST;
    const PACKAGE_2 = Package::MIDDLE;
    const PACKAGE_3 = Package::HIGHEST;

    protected $fillable = ['store_name', 'mag_store_id', 'mag_cat_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profile()
    {
        return $this->hasOne(Profile::class); // or Profile::class
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany('App\Product'); // or Profile::class
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function references()
    {
        return $this->hasMany('App\Reference'); // or Profile::class
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\User'); // or Profile::class
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function image()
    {
        return $this->belongsTo('App\Image'); // or Profile::class
    }

    /**
     * Get the Location that owns the Store.
     */
    public function location()
    {
        return $this->belongsTo('App\Location');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function manufacturers()
    {
        return $this->belongsToMany(Manufacturer::class);
    }

    public function getNumberOfReferences()
    {
        return count($this->references);
    }

    public function getNumberOfProducts()
    {
        return count($this->products);
    }

    public function getStoreLogo()
    {
        if (!empty($this->image))
            return $this->image->getImageUrl();
        else
            return '';
    }

    public function getStoreCoverImage()
    {
        if (!empty($this->cover_url))
            return $this->cover_url;
        else
            return '';
    }

    /**
     * @return mixed
     */
    public function package_name()
    {
        $profile = Profile::where(['store_id' => $this->id])->get()->first();

        $package = $profile->package;
        return $package->name;
    }

    public function getStoreBrands()
    {
        $brands = array();
        /** @var $reference \App\Reference */
        foreach ($this->references as $reference) {
            foreach ($reference->manufacturers as $manufacturer) {
                if (!in_array($manufacturer->id, $brands))
                    $brands[] = $manufacturer->id;
            }
        }

        return Manufacturer::whereIn('id', $brands)->get();
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function getOneStopShopData()
    {
        return array_filter(explode(",", Field::getSelectedValues("onestopshop", $this)));
    }

    public function getStoreData()
    {
        $store = $this;
        $datablock = array();
        $datablock["topditop_offer"] = array_filter(explode(",", Field::getSelectedValues("topditop_offer", $store)));
        $datablock["TopDiTop_Service"] = array_filter(explode(",", Field::getSelectedValues("TopDiTop_Service", $store)));
        $datablock["onestopshop"] = array_filter(explode(",", Field::getSelectedValues("onestopshop", $store)));
        $datablock["description"] = Field::getSelectedValues("description", $store);
        $datablock["address"] = Field::getSelectedValues("address", $store);

        $datablock["brands"] = array_filter(explode(",", Field::getSelectedValues("brands", $store)));


        $datablock["from_working_days"] = Field::getSelectedValues("from_working_days", $store);
        $datablock["to_working_days"] = Field::getSelectedValues("to_working_days", $store);
        $datablock["from_weekends"] = Field::getSelectedValues("from_weekends", $store);
        $datablock["to_weekends"] = Field::getSelectedValues("to_weekends", $store);

        $datablock["philosophy"] = Field::getSelectedValues("philosophy", $store);
        $datablock["quotation"] = Field::getSelectedValues("quotation", $store);
        $datablock["owner"] = Field::getSelectedValues("owner", $store);
        $datablock["contact_mail"] = Field::getSelectedValues("contact_mail", $store);
        $datablock["website"] = Field::getSelectedValues("website", $store);
        $datablock["telephone_number"] = Field::getSelectedValues("telephone_number", $store);
        $datablock["facebook_fanpage"] = Field::getSelectedValues("facebook_fanpage", $store);

        $datablock["store_latitude"] = Field::getSelectedValues("store_latitude", $store);
        $datablock["store_longitude"] = Field::getSelectedValues("store_longitude", $store);

        return $datablock;
    }

    public function getLatitude()
    {
        if ($this->uses_coordinates) {
            return $this->latitude;
        } else {
            return $this->profile->fields->first(function ($key, $value) {
                return $value == 'store_latitude';
            });
        }
    }

    public function getLongitude()
    {
        if ($this->uses_coordinates) {
            return $this->longitude;
        } else {
            return $this->profile->fields->first(function ($key, $value) {
                return $value == 'store_longitude';
            });
        }
    }

    public function getFieldByKey($key)
    {
        return array_filter(explode(",", Field::getSelectedValues($key, $this)));
    }

    public function getLightAddress()
    {
        $origin = $this->user->origin;

        if ($origin == null) {
            return "";
        }

        return "$origin->street+$origin->house_number+$origin->additional_address_info+$origin->city";
    }

    public function isTopDiTop()
    {
        return $this->profile->package->name == Package::HIGHEST;
    }

    public function isTop()
    {
        return $this->profile->package->name == Package::MIDDLE;
    }

    public function isLowest()
    {
        return $this->profile->package->name == Package::LOWEST;
    }

    public function isLight()
    {
        return $this->profile->package->name == Package::LIGHT || $this->is_light;
    }
}
