<?php

namespace App\Filters;

use App\Filters\Common\FilterHelper;
use App\Manufacturer;
use App\Reference;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

/**
 * Class ReferencesFilter
 * @package App\Filters
 */
class ReferencesFilter implements FilterHelper
{
    /**
     * @param $reference
     * @return mixed
     */
    public function buildReturnObject($reference)
    {

        /** @var Reference $reference */
        $reference->image = $reference->getImageByThumb('reference_thumb');
        $reference->package_name = $reference->package_name();
        $reference->store_name = $reference->store->store_name;
        $reference->date = $reference->getNiceDate();
        $reference->numImages = $reference->getNumberOfImages();
        $reference->scenes = trans('messages.scene');
        return $reference;
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
            if (isset($searchObject['storeParams']) && !empty($searchObject['storeParams']) && !isset($searchObject['brandParams'])) {
                $case = 'stores';
            } else if (empty($searchObject['storeParams']) && !empty($searchObject['brandParams'])) {
                $case = 'brands';
            } else if (!empty($searchObject['storeParams']) && isset($searchObject['brandParams'])) {
                $case = 'both';
            } else {
                $case = 'empty';
            }
        }
        return $case;
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
        $manufacturers = Manufacturer::with('references')->whereIn('id', $brandParams)->get();

        foreach ($manufacturers as $manufacturer) {
            foreach ($manufacturer->references as $reference) {
                $reference = $this->buildReturnObject($reference);
                if (!$collection->contains($reference))
                    $collection->add($reference);
            }
        }
        return $collection;
    }

    /**
     * @param $collection
     * @param $request
     * @param $storesKey
     * @return mixed
     */
    public function buildStoresCollection($collection, $request, $storesKey)
    {
        $searchObject = $request->searchObject;
        $storeParams = $searchObject[$storesKey];
        $referencesByStores = Reference::whereIn('store_id', $storeParams)->get();

        foreach ($referencesByStores as $reference) {
            $reference = $this->buildReturnObject($reference);
            if (!$collection->contains($reference))
                $collection->add($reference);
        }
        return $collection;
    }

    /**
     * @param Collection $collection
     * @return Collection
     */
    public function buildDefaultCollection(Collection $collection)
    {
        $references = Reference::with('images')->get();
        foreach ($references as $reference) {
            $reference = $this->buildReturnObject($reference);
            if (!$collection->contains($reference))
                $collection->add($reference);
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
     * @return Collection
     */
    public function applyFilter(Request $request)
    {
        $case = $this->identifyCase($request);
        $collection = new Collection();

        switch ($case) {
            case 'empty' :
                $collection = $this->buildDefaultCollection($collection);
                break;
            case 'stores' :
                $collection = $this->buildStoresCollection($collection, $request, 'storeParams');
                break;
            case 'brands' :
                $collection = $this->buildBrandsCollection($collection, $request, 'brandParams');
                break;
            case 'both':
                $collection1 = $this->buildBrandsCollection($collection, $request, 'brandParams');
                $collection2 = $this->buildStoresCollection($collection, $request, 'storeParams');
                $collection = $this->mergeCollections($collection, $collection1, $collection2);
                break;
            default:
                break;
        }

        return $collection;
    }
}