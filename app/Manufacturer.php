<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Manufacturer extends Model
{

    protected $fillable = ['name', 'image_url'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany('App\Product'); // or Profile::class
    }

    public function references()
    {
        return $this->belongsToMany('App\Reference'); // or Profile::class
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function stores()
    {
        return $this->belongsToMany(Store::class);
    }

    public function numberOfReferences()
    {
        return count($this->references()->get());
    }

    public function numberOfReferencesForStore(Store $store)
    {
        $references = $this->references;
        $count = 0;
        foreach ($references as $reference) {
            if ($reference->status == 1 && $reference->store->id == $store->id) {
                $count++;
            }
        }
        return $count;
    }

    public function numberOfProducts()
    {
        return count($this->products()->get());
    }

    public function numberOfProductsForStore($store, $manufacturerId)
    {
        $result = DB::table('manufacturers')
            ->leftJoin('products', 'manufacturers.id', '=', 'products.manufacturer_id')
            ->where('products.store_id', '=', $store->id)
            ->where('manufacturers.id', '=', $manufacturerId)
            ->count();

        return $result;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function advert()
    {
        return $this->hasOne('App\Advert'); // or Profile::class
    }

    public function getImageUrl()
    {
        #/var/www/html/topditop2/magento1931/media/Foundcenter logo.png
        return str_replace('/var/www/html/', 'http://138.201.246.165/', $this->image_url);
    }

    /**
     * @return int
     */
    public function numberOfStores()
    {

        $res = \Illuminate\Support\Facades\DB::select('SELECT count(DISTINCT `references`.store_id)
FROM `references`
INNER JOIN manufacturer_reference
ON `references`.id=manufacturer_reference.reference_id
where manufacturer_reference.manufacturer_id= :id', ['id' => $this->id]);
        $count = $this->get_val($res);
        return $count;
    }

    public function get_val($res)
    {
        $val = $res[0];
        $num = 0;
        foreach ($val as $item) {
            $num = $item;
        }
        return $num;
    }
}