<?php

namespace App\Filters;

use App\Filters\Common\FilterHelper;
use App\Manufacturer;
use App\Product;
use App\Store;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

/**
 * Class ProductsFilter
 * @package App\Filters
 */
class ProductsFilterFront implements FilterHelper
{
    /**
     * @param Product $product
     * @return Product
     */
    public function buildReturnObject($product)
    {
        $product->image = $product->getImageByThumb('reference_thumb');
        $product->manufacturer_name = $product->manufacturer->name;
        $product->references = $product->getNumberOfReferences();
        $product->package_name = $product->package_name();
        $product->store_name = $product->store->store_name;
        return $product;
    }

    public function identifyCase(Request $request)
    {
        if (empty($request->searchObject)) {
            $case = 'empty';
        } else {
            $searchObject = $request->searchObject;
            if (empty($searchObject['brandParams']) && !empty($searchObject['storeParams'])) {
                $case = 'stores';
            } else if (empty($searchObject['storeParams']) && !empty($searchObject['brandParams'])) {
                $case = 'brands';
            } else if (!empty($searchObject['storeParams']) && !empty($searchObject['brandParams'])) {
                $case = 'both';
            } else {
                $case = 'empty';
            }
        }
        return $case;
    }

    public function applyFilter(Request $request)
    {
        $case = $this->identifyCase($request);

        $collection = new Collection();

        switch ($case) {
            case 'empty' :
                $products = Product::orderBy('id', 'desc')->get();

                foreach ($products as $product) {
                    $product = $this->buildReturnObject($product);
                    if (!$collection->contains($product))
                        $collection->add($product);
                }
                break;
            case 'stores' :
                $searchObject = $request->searchObject;
                $storeParams = $searchObject['storeParams'];
                $stores = Store::with('products')->whereIn('id', $storeParams)->get();

                foreach ($stores as $store) {
                    foreach ($store->products as $product) {
                        $product = $this->buildReturnObject($product);
                        if (!$collection->contains($product)) {
                            $collection->add($product);
                        }
                    }
                }

                break;

            case 'brands' :
                $searchObject = $request->searchObject;
                $brandParams = $searchObject['brandParams'];
                $manufacturers = Manufacturer::with('products')->whereIn('id', $brandParams)->get();

                foreach ($manufacturers as $manufacturer) {
                    foreach ($manufacturer->products as $product) {
                        $product = $this->buildReturnObject($product);
                        if (!$collection->contains($product)) {
                            $collection->add($product);
                        }
                    }
                }
                break;
            case 'both':
                $searchObject = $request->searchObject;
                $brandParams = $searchObject['brandParams'];
                $storeParams = $searchObject['storeParams'];
                $manufacturers = Manufacturer::with('products')->whereIn('id', $brandParams)->get();
                $stores = Store::with('products')->whereIn('id', $storeParams)->get();

                foreach ($manufacturers as $manufacturer) {
                    foreach ($manufacturer->products as $product) {
                        $product = $this->buildReturnObject($product);
                        if (!$collection->contains($product) && $stores->contains($product->store)) {
                            $collection->add($product);
                        }
                    }
                }
                break;
            default:
                break;
        }

        return $collection;
    }
}