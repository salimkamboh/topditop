<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Manufacturer extends Model
{

    protected $fillable = ['name', 'featured'];

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
        if (! $this->image_url) {
            return 'http://placehold.it/350x180';
        }
        return url('images' . $this->image_url);
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

    private function cutAbsolutePath()
    {
        if (! $this->image_url) {
            return;
        }
        $messyRelativePath = parse_url($this->image_url, PHP_URL_PATH);
        $cleanRelativePath = str_replace('/topditop/images/', '/images/', $messyRelativePath);
        $cleanRelativePath = str_replace('/images/', '/', $cleanRelativePath);
        $this->image_url = $cleanRelativePath;
        $this->save();
    }

    static function replaceAllImagesPath()
    {
        $manufacturers = Manufacturer::all();

        foreach ($manufacturers as $manufacturer) {
            $manufacturer->cutAbsolutePath();
        }
    }
}
