<?php

namespace App\Filters;

use App\Filters\Common\FilterHelper;
use App\Manufacturer;
use App\Reference;
use App\Store;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

/**
 * Class ReferencesGalleryFilter
 * @package App\Filters
 */
class ReferencesGalleryFilter implements FilterHelper
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
            if (empty($searchObject['storeParams']) && !empty($searchObject['brandParams'])) {
                $case = 'brands';
            } else {
                $case = 'empty';
            }
        }
        return $case;
    }

    /**
     * @param Collection $collection
     * @param Request $request
     * @param Store $store
     * @param $brandKey
     * @return Collection
     */
    public function buildBrandsCollection(Collection $collection, Request $request, Store $store, $brandKey)
    {
        $searchObject = $request->searchObject;
        $brandParams = $searchObject[$brandKey];
        $manufacturers = Manufacturer::with('references')->whereIn('id', $brandParams)->get();
        foreach ($manufacturers as $manufacturer) {
            foreach ($manufacturer->references as $reference) {
                $reference = $this->buildReturnObject($reference);
                if (!$collection->contains($reference) && $reference->store->id == $store->id && $reference->status == 1) {
                    $collection->add($reference);
                }
            }
        }
        return $collection;
    }

    /**
     * @param Collection $collection
     * @param Store $store
     * @return Collection
     */
    public function buildDefaultCollection(Collection $collection, Store $store)
    {
        $references = Reference::where(['status' => '1', 'store_id' => $store->id])->limit(12)->offset(0)->orderBy('id', 'desc')->get();
        foreach ($references as $reference) {
            $reference = $this->buildReturnObject($reference);
            if (!$collection->contains($reference))
                $collection->add($reference);
        }
        return $collection;
    }

    public function applyFilter(Request $request)
    {
        // TODO: Implement applyFilter() method.
    }

    /**
     * @param Request $request
     * @return Collection
     */
    public function applyFilterForStore(Request $request, Store $store)
    {
        $case = $this->identifyCase($request);
        $collection = new Collection();

        switch ($case) {
            case 'empty' :
                $collection = $this->buildDefaultCollection($collection, $store);
                break;
            case 'brands' :
                $collection = $this->buildBrandsCollection($collection, $request, $store, 'brandParams');
                break;
            default:
                break;
        }

        return $collection;
    }
}