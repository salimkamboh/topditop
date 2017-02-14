<?php

namespace App\Http\Controllers;

use App\Filters\ProductsFilter;
use App\Filters\ProductsFilterFront;
use App\Filters\ReferencesFilter;
use App\Filters\ReferencesGalleryFilter;
use App\Filters\StoresFilter;
use App\Store;
use Illuminate\Http\Request;

class FilterController extends BaseController
{

    protected $storesFilter;
    protected $productsFilterFront;
    protected $productsFilter;
    protected $referencesFilter;
    protected $referencesGalleryFilter;

    public function __construct(StoresFilter $storesFilter,
                                ProductsFilterFront $productsFilterFront,
                                ProductsFilter $productsFilter,
                                ReferencesFilter $referencesFilter,
                                ReferencesGalleryFilter $referencesGalleryFilter)
    {
        parent::__construct();
        $this->storesFilter = $storesFilter;
        $this->productsFilter = $productsFilter;
        $this->productsFilterFront = $productsFilterFront;
        $this->referencesFilter = $referencesFilter;
        $this->referencesGalleryFilter = $referencesGalleryFilter;
    }

    public function multiFilterStores(Request $request) {
        return $this->storesFilter->applyFilter($request);
    }

    public function multiFilterProducts(Request $request) {
        return $this->productsFilter->applyFilter($request);
    }

    public function multiFilterProductsFront(Request $request) {
        return $this->productsFilterFront->applyFilter($request);
    }

    public function multiFilterReferences(Request $request) {
        return $this->referencesFilter->applyFilter($request);
    }

    public function multiFilterReferencesGallery(Request $request, Store $store) {
        return $this->referencesGalleryFilter->applyFilterForStore($request, $store);
    }

}