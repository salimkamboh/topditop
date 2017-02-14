<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Advert extends Model
{
    protected $fillable = ['scanned_image_url', 'brand_logo_url', 'reference_image_url', 'store_id', 'manufacturer_id', 'name'];

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

    /**
     * @param $items
     * @param $params
     * @return array
     */
    public function getCloseLocations($items, $params)
    {
        $finalItems = array();
        foreach ($items as $_items) {
            $_finalItems = array();
            foreach ($_items as $_item) {
                $_finalItems[] = $_item;
            }
            $finalItems[] = $_finalItems;
        }

        $distances = array_map(function ($item) use ($params) {
            $a = $item;
            return $this->distance($a, $params);
        }, $finalItems);

        asort($distances);

        $locationkeys = array();
        foreach ($distances as $key => $value) {
            $locationkeys[] = $key;
        }

        return $this->sortArrayByArray($items, $locationkeys);
    }

    /**
     * @param $a
     * @param $b
     * @return float
     */
    public function distance($a, $b)
    {
        list($lat1, $lon1) = $a;
        list($lat2, $lon2) = $b;

        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        return $miles;
    }

    /**
     * @param $itemsNew
     * @param $insertItem
     * @return bool
     */
    public function array_contains($itemsNew, $insertItem)
    {
        foreach ($itemsNew as $item) {
            if ($item->store_id == $insertItem->store_id && $item->key == $insertItem->key) {
                return true;
            }
        }
        return false;
    }

    public function getAllLocationsOfStores($locale, $brandName)
    {
        $selectQuery = 'SELECT field_profile_translations.selected, fields.key, profiles.store_id as store_id, stores.store_name as store_name, `references`.id as refId,`manufacturers`.name as brandname
FROM fields
INNER JOIN field_profile
ON fields.id=field_profile.field_id
INNER JOIN field_profile_translations ON field_profile.id = field_profile_translations.field_profile_id 
INNER JOIN profiles ON profiles.id = field_profile.profile_id
INNER JOIN stores ON stores.id = profiles.store_id
INNER JOIN `references` ON `references`.`store_id` = stores.id
INNER JOIN manufacturer_reference ON `manufacturer_reference`.`reference_id` = `references`.id
INNER JOIN manufacturers ON `manufacturers`.`id` = `manufacturer_reference`.`manufacturer_id`
WHERE field_profile_translations.locale = \'' . $locale . '\' AND `manufacturers`.name = \'' . $brandName . '\' AND ( `key` = \'store_longitude\' OR `key` = \'store_latitude\')
ORDER BY field_profile.profile_id';

        $items = DB::select($selectQuery);


        $itemsNew = array();
        foreach ($items as $item) {
            if (!$this->array_contains($itemsNew, $item))
                $itemsNew[] = $item;
        }

        $storeIds = array();
        foreach ($itemsNew as $item) {
            if (!in_array($item->store_id, $storeIds))
                $storeIds[] = $item->store_id;
        }

        $result = array();
        foreach ($storeIds as $storeId) {
            $resultItem = array();
            $counter = 1;
            foreach ($itemsNew as $item) {
                if ($item->store_id == $storeId) {
                    $resultItem[] = $item->selected;

                    if ($counter == 2) {
                        if (!in_array($item->store_id, $resultItem))
                            $resultItem[] = $item->store_id;

                        if (!in_array($item->store_name, $resultItem))
                            $resultItem[] = $item->store_name;
                    }
                    $counter++;
                }
            }
            $result[] = $resultItem;
        }

        return $result;
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
