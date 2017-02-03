<?php

namespace App\Filters;

use App\Filters\Common\FilterHelper;
use App\Http\Controllers\BaseController;
use App\Manufacturer;
use App\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

/**
 * Class ProductsFilter
 * @package App\Filters
 */
class ProductsFilter extends BaseController implements FilterHelper
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
            if (isset($searchObject['searchParams']) && !empty($searchObject['searchParams']) && !isset($searchObject['brandParams'])) {
                $case = 'keys';
            } else if (empty($searchObject['searchParams']) && !empty($searchObject['brandParams'])) {
                $case = 'brands';
            } else if (!empty($searchObject['searchParams']) && isset($searchObject['brandParams'])) {
                $case = 'both';
            } else {
                $case = 'empty';
            }
        }
        return $case;
    }

    /**
     * @param Request $request
     * @return Collection
     */
    public function applyFilter(Request $request)
    {
        $store = $this->current_store;
        $case = $this->identifyCase($request);

        $collection = new Collection();

        switch ($case) {
            case 'empty' :
                $products = Product::where(['store_id' => $store->id])->orderBy('id', 'desc')->get();

                foreach ($products as $product) {
                    $product = $this->buildReturnObject($product);
                    if (!$collection->contains($product) && $product->store->id == $store->id)
                        $collection->add($product);
                }
                break;
            case 'keys' :
                $searchObject = $request->searchObject;
                $searchParams = $searchObject['searchParams'];
                $products = Product::where(['store_id' => $store->id])->where('title', 'like', '%' . $searchParams . '%')->orderBy('id', 'desc')->get();

                foreach ($products as $product) {
                    $product = $this->buildReturnObject($product);
                    if (!$collection->contains($product) && $product->store->id == $store->id)
                        $collection->add($product);
                }
                break;
            case 'brands' :
                $searchObject = $request->searchObject;
                $brandParams = $searchObject['brandParams'];
                $manufacturers = Manufacturer::with('products')->whereIn('id', $brandParams)->get();

                foreach ($manufacturers as $manufacturer) {
                    foreach ($manufacturer->products as $product) {
                        $product = $this->buildReturnObject($product);
                        if (!$collection->contains($product) && $product->store->id == $store->id) {
                            $collection->add($product);
                        }
                    }
                }
                break;
            case 'both':
                $searchObject = $request->searchObject;
                $brandParams = $searchObject['brandParams'];
                $searchParams = $searchObject['searchParams'];
                $manufacturers = Manufacturer::with('products')->whereIn('id', $brandParams)->get();

                foreach ($manufacturers as $manufacturer) {
                    foreach ($manufacturer->products as $product) {
                        $product = $this->buildReturnObject($product);
                        if (!$collection->contains($product) && $product->store->id == $store->id) {
                            if (strpos($product->title, $searchParams) !== false) {
                                $collection->add($product);
                            }
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