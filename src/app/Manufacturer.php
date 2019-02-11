<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * App\Manufacturer
 *
 * @property int $id
 * @property string $name
 * @property string $url
 * @property string $image_url
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $featured
 * @property int $brandreferences_count
 * @property-read \App\Advert $advert
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\BrandReference[] $brandreferences
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Product[] $products
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Reference[] $references
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Store[] $stores
 * @method static \Illuminate\Database\Query\Builder|\App\Manufacturer whereBrandreferencesCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Manufacturer whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Manufacturer whereFeatured($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Manufacturer whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Manufacturer whereImageUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Manufacturer whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Manufacturer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Manufacturer whereUrl($value)
 * @mixin \Eloquent
 */
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

    public function brandreferences()
    {
        return $this->hasMany(BrandReference::class);
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
