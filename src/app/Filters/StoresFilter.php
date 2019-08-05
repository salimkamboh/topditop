<?php

namespace App\Filters;

use App\Field;
use App\FieldProfile;
use App\Filters\Common\FilterHelper;
use App\Image;
use App\Manufacturer;
use App\Store;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

/**
 * Class StoresFilter
 * @package App\Filters
 */
class StoresFilter implements FilterHelper
{
    /**
     * @param $entity
     * @return Store
     */
    public function buildReturnObject($entity)
    {
        /** @var Store $entity */
        $entity->numberReferences = $entity->getNumberOfReferences();
        $entity->categories = $entity->getCategoriesNiceArray();
        $entity->location = $entity->location->translate()->name;
        $entity->scenes = trans('messages.scene');
        if ($entity->image instanceof Image) {
            $entity->image->url = $entity->image->getImageUrl();
        }
        return $entity;
    }

    /**
     * @param Request $request
     * @return string
     */
    public function identifyCase(Request $request)
    {
        if (empty($request->searchObject)) {
            $case = 'empty';
        } else {
            $searchObject = $request->searchObject;
            if (empty($searchObject['brandParams']) && empty($searchObject['categoriesParams']) && !empty($searchObject['locationParams'])) {
                $case = 'locations';
            } else if (empty($searchObject['locationParams']) && empty($searchObject['categoriesParams']) && !empty($searchObject['brandParams'])) {
                $case = 'brands';
            } else if (empty($searchObject['locationParams']) && empty($searchObject['brandParams']) && !empty($searchObject['categoriesParams'])) {
                $case = 'categories';
            } else if (empty($searchObject['locationParams']) && !empty($searchObject['brandParams']) && !empty($searchObject['categoriesParams'])) {
                $case = 'brands-and-categories';
            } else if (!empty($searchObject['locationParams']) && empty($searchObject['brandParams']) && !empty($searchObject['categoriesParams'])) {
                $case = 'locations-and-categories';
            } else if (!empty($searchObject['locationParams']) && !empty($searchObject['brandParams']) && empty($searchObject['categoriesParams'])) {
                $case = 'locations-and-brands';
            } else if (!empty($searchObject['locationParams']) && !empty($searchObject['brandParams']) && !empty($searchObject['categoriesParams'])) {
                $case = 'all';
            } else {
                $case = 'empty';
            }           
        }
        return $case;
    }

    /**
     * @param Collection $collection
     * @return Collection
     */
    public function buildDefaultCollection(Collection $collection)
    {
        $stores = Store::active()->with('image')->orderBy('store_name')->get();
        foreach ($stores as $store) {
            $store = $this->buildReturnObject($store);
            if (!$collection->contains($store))
                $collection->add($store);
        }
        return $collection;
    }

    /**
     * @param $collection
     * @param $request
     * @param $locationKey
     * @return mixed
     */
    public function buildLocationsCollection($collection, $request, $locationKey)
    {
        $searchObject = $request->searchObject;
        $locationParams = $searchObject[$locationKey];
        $stores = Store::active()->whereIn('location_id', $locationParams)->with('image')->orderBy('store_name')->get();

        foreach ($stores as $store) {
            $store = $this->buildReturnObject($store);
            if (!$collection->contains($store))
                $collection->add($store);
        }
        return $collection;
    }

    /**
     * @param $collection
     * @param $request
     * @param $brandKey
     * @return mixed
     */
    public function buildBrandsCollection($collection, $request, $brandKey)
    {
        $searchObject = $request->searchObject;
        $brandParams = $searchObject[$brandKey];

        $store_ids = [];

        $manufacturers = Manufacturer::whereIn('id', $brandParams)->with('stores')->get();

        foreach ($manufacturers as $manufacturer) {
            foreach ($manufacturer->stores as $store) {
                $store_ids []= $store->id;
            }
        }

        $uniqueStoreIds = array_unique($store_ids);

        $stores = Store::active()->whereIn('id', $uniqueStoreIds)->with('image', 'references')->orderBy('store_name')->get();

        foreach ($stores as $store) {
            $item = $this->buildReturnObject($store);

            if (!$collection->contains($item)) {
                $collection->add($item);
            }
        }
        return $collection;
    }
    
    /**
     * @param $collection
     * @param $request
     * @param $categoriesKey
     * @return mixed
     */
    public function buildCategoriesCollection($collection, $request, $categoriesKey)
    {
        $searchObject = $request->searchObject;
        $catParams = $searchObject[$categoriesKey];

        $cat_ids = array();
        
        foreach ($catParams as $catParam) {
            if (!in_array($catParam, $cat_ids)) {
                $cat_ids[] = $catParam;
            }
          }
        
        $stores = Store::whereHas('categories', function($q) use($cat_ids) {
            $q->whereIn('categories.id', $cat_ids);
        })->get();
        
        foreach ($stores as $store) {
            $store = $this->buildReturnObject($store);
            if (!$collection->contains($store))
                $collection->add($store);
        }

        return $collection;
    }

    /**
     * @param Collection $collection
     * @param Collection $collection1
     * @param Collection $collection2
     * @param Collection|null $collection3
     * @return Collection
     */
    public function mergeCollections(Collection $collection, Collection $collection1, Collection $collection2, Collection $collection3 = null)
    {
        foreach ($collection1 as $item) {
            if (!$collection->contains($item))
                $collection->add($item);
        }
        foreach ($collection2 as $item) {
            if (!$collection->contains($item) && $collection1->contains($item))
                $collection->add($item);
        }

        if ($collection3 != null) {
            foreach ($collection3 as $item) {
                if (!$collection->contains($item) && $collection1->contains($item) && $collection2->contains($item))
                    $collection->add($item);
            }
        }
        return $collection;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function applyFilter(Request $request)
    {
        $case = $this->identifyCase($request);
        $collection = new Collection();

        switch ($case) {
            case 'empty' :
                $collection = $this->buildDefaultCollection($collection);
                break;
            case 'locations' :
                $collection = $this->buildLocationsCollection($collection, $request, 'locationParams');
                break;
            case 'brands' :
                $collection = $this->buildBrandsCollection($collection, $request, 'brandParams');
                break;
            case 'categories':
                $collection = $this->buildCategoriesCollection($collection, $request, 'categoriesParams');
                break;
            case 'brands-and-categories':
                $collection1 = $this->buildBrandsCollection($collection, $request, 'brandParams');
                $collection2 = $this->buildCategoriesCollection($collection, $request, 'categoriesParams');
                $collection = $this->mergeCollections($collection, $collection1, $collection2);
                break;
            case 'locations-and-categories':
                $collection1 = $this->buildLocationsCollection($collection, $request, 'locationParams');
                $collection2 = $this->buildCategoriesCollection($collection, $request, 'categoriesParams');
                $collection = $this->mergeCollections($collection, $collection1, $collection2);
                break;
            case 'locations-and-brands':
                $collection1 = $this->buildLocationsCollection($collection, $request, 'locationParams');
                $collection2 = $this->buildBrandsCollection($collection, $request, 'brandParams');
                $collection = $this->mergeCollections($collection, $collection1, $collection2);
                break;
            case 'all':
                $collection1 = $this->buildLocationsCollection($collection, $request, 'locationParams');
                $collection2 = $this->buildBrandsCollection($collection, $request, 'brandParams');
                $collection3 = $this->buildCategoriesCollection($collection, $request, 'categoriesParams');
                $collection = $this->mergeCollections($collection, $collection1, $collection2, $collection3);
                break;
            default:
                break;
        }
        return $collection;
    }
}