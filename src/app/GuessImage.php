<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * App\GuessImage
 *
 * @property int $id
 * @property string $scanned_image_url
 * @property string $brand_logo_url
 * @property string $reference_image_url
 * @property int $manufacturer_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $name
 * @property string $craftar_item_uuid
 * @property string $craftar_image_uuid
 * @property-read \App\Manufacturer $manufacturer
 * @method static \Illuminate\Database\Query\Builder|\App\Advert whereBrandLogoUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Advert whereCraftarImageUuid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Advert whereCraftarItemUuid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Advert whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Advert whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Advert whereManufacturerId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Advert whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Advert whereReferenceImageUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Advert whereScannedImageUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Advert whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class GuessImage extends Model
{
    protected $table = 'guess_images';

    protected $fillable = ['scanned_image_url', 'brand_logo_url', 'reference_image_url', 'store_id', 'manufacturer_id', 'name'];

    protected $casts = [
        'details' => 'array',
    ];
    public function manufacturer()
    {
        return $this->belongsTo('App\Manufacturer');
    }

    /**
     * @param array $array
     * @param array $orderArray
     * @return array
     */
    public function sortArrayByArray(array $array, array $orderArray)
    {
        $ordered = array();
        foreach ($orderArray as $key) {
            if (array_key_exists($key, $array)) {
                $ordered[$key] = $array[$key];
                unset($array[$key]);
            }
        }
        return $ordered + $array;
    }

    public function getReferenceImageUrl()
    {
        return url('images' . $this->reference_image_url);
    }

    public function getScannedImageUrl()
    {
        return url('images' . $this->scanned_image_url);
    }

    public function getBrandLogoUrl()
    {
        return url('images' . $this->brand_logo_url);
    }

    private function cutAbsolutePath()
    {
        $this->cutAbsolutePathForProperty('scanned_image_url');
        $this->cutAbsolutePathForProperty('brand_logo_url');
        $this->cutAbsolutePathForProperty('reference_image_url');

        $this->save();
    }

    private function cutAbsolutePathForProperty($property_url)
    {
        $messyRelativePath = parse_url($this->getAttribute($property_url), PHP_URL_PATH);
        $cleanRelativePath = str_replace('/topditop/images/', '/images/', $messyRelativePath);
        $cleanRelativePath = str_replace('/images/', '/', $cleanRelativePath);
        $this->setAttribute($property_url, $cleanRelativePath);
    }

    static function replaceAllImagesPath()
    {
        $adverts = Advert::all();

        foreach ($adverts as $advert) {
            $advert->cutAbsolutePath();
        }
    }
}
