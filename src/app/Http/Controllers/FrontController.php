<?php

namespace App\Http\Controllers;

use App\Advert;
use App\BrandReference;
use App\Category;
use App\Entity\Store\Repository as StoreRepository;
use App\Entity\Location\Repository as LocationRepository;
use App\Field;
use App\Location;
use App\Manufacturer;
use App\Package;
use App\Product;
use App\Reference;
use App\Services\StoreService;
use App\Store;
use DB;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class FrontController extends BaseController
{

    private $settingsRepository;
    /**
     * @var LocationRepository
     */
    private $locationRepository;

    /**
     * FrontController constructor.
     * @param StoreRepository $settingsRepository
     * @param LocationRepository $locationRepository
     */
    public function __construct(StoreRepository $settingsRepository, LocationRepository $locationRepository)
    {
        parent::__construct();
        $this->settingsRepository = $settingsRepository;
        $this->locationRepository = $locationRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function contactPage()
    {
        return view('front.pages.contact');
    }

    public function advertisementShow(Advert $advert, Request $request, StoreService $storeService)
    {
        $latitude = (float) $request->get('latitude', config('advertisement.fallback_latitude'));
        $longitude = (float) $request->get('longitude', config('advertisement.fallback_longitude'));

        $closestStore = $storeService->findNearestStoreForManufacturer($advert->manufacturer_id, $latitude, $longitude);

        if (! $closestStore instanceof Store) {
            // redirect to brand page instead
            return redirect()->route('front_brand_stores', $advert->manufacturer_id);
        }

        return redirect()->route('front_show_store', $closestStore->id);
    }

    /**
     * @param Store $store
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function frontShowStore(Store $store)
    {
        $store->load('manufacturers.brandreferences.category');
        if ($store->status == 0) {
          throw new ModelNotFoundException();
        }
        $manufacturers = $store->manufacturers;
        $brandreferences = [];
        foreach ($manufacturers as $manufacturer) {
            foreach ($manufacturer->brandreferences as $brandreference) {
                $brandreferences []= $brandreference;
            }
        }
        $datablock = $this->settingsRepository->getStoreData($store);

        $references_newest = Reference::active()->where('store_id', $store->id)->limit(12)->offset(0)->orderBy('id', 'desc')->get();
        $references_most = Reference::active()->where('store_id', $store->id)->limit(12)->offset(0)->orderBy('views', 'desc')->get();

        $products_newest = $store->products()->limit(6)->offset(0)->orderBy('id', 'desc')->get();
        $products_most = $store->products()->limit(6)->offset(0)->orderBy('views', 'desc')->get();

        $architects = explode(',', $datablock["add-new-architect"]);
        array_pop($architects);



        return view('front.stores.single')
            ->with('store', $store)
            ->with('references_newest', $references_newest)
            ->with('references_most', $references_most)
            ->with('manufacturers', $manufacturers)
            ->with('brandreferences', $brandreferences)
            ->with('products_newest', $products_newest)
            ->with('products_most', $products_most)
            ->with('architects', $architects)
            ->with('datablock', $datablock);
    }

    public function frontShowStoresLocation(Location $location)
    {
        $categories = Category::all();
        $stores = Store::active()->where('location_id', '=', $location->id)->orderBy('store_name')->get();
        $products = Product::all();
        $manufacturers = Manufacturer::orderBy('name', 'asc')->get();
        $filter_locations = Location::all();
        return view('front.stores.list-search-results')
            ->with('products', $products)
            ->with('filter_locations', $filter_locations)
            ->with('manufacturers', $manufacturers)
            ->with('categories', $categories)
            ->with('stores', $stores);
    }

    public function frontShowResults(Request $request)
    {
        $name = $request->get('name', null);
        if ($name == null) {
            return redirect()->route('front_stores');
        }

        $categories = Category::all();
        $stores = Store::active()->where('store_name', 'LIKE', '%' . $name . '%')->paginate(12);
        $products = Product::all();
        $manufacturers = Manufacturer::orderBy('name', 'asc')->get();
        $filter_locations = Location::all();
        return view('front.stores.list-search-results')
            ->with('products', $products)
            ->with('name', $name)
            ->with('filter_locations', $filter_locations)
            ->with('manufacturers', $manufacturers)
            ->with('categories', $categories)
            ->with('stores', $stores);
    }

    public function showReferences()
    {
        $references = Reference::active()->get();
        $stores = Store::active()->get();
        $manufacturers = Manufacturer::orderBy('name', 'asc')->get();
        return view('front.references.list')
            ->with('references', $references)
            ->with('manufacturers', $manufacturers)
            ->with('stores', $stores);
    }

    public function showReferenceGallery(Store $store)
    {
        $package = new Package();
        if ($store->package_name() != $package::HIGHEST) {
            return redirect()->route('default');
        }

        $references_newest = Reference::active()->where('store_id', $store->id)->limit(12)->offset(0)->orderBy('id', 'desc')->get();
        $references_most = Reference::active()->where('store_id', $store->id)->limit(12)->offset(0)->orderBy('views', 'desc')->get();
        $manufacturers = Manufacturer::orderBy('name', 'asc')->get();
        $allow_sharing = Field::getSelectedValues("allow_sharing", $store);
        return view('front.references.gallery')
            ->with('references_newest', $references_newest)
            ->with('references_most', $references_most)
            ->with('manufacturers', $manufacturers)
            ->with('store', $store)
            ->with('allow_sharing', $allow_sharing)
            ->with('ref_store', $store);
    }

    /**
     * @param Reference $reference
     * @return mixed
     */
    public function showReferenceSingle(Reference $reference)
    {
        if ($reference->package_name() != Store::PACKAGE_3) {
            return redirect()->route('default');
        }

        $reference->incrementViews();

        $datablock = $this->settingsRepository->getStoreData($reference->store);
        $selected_products = $reference->products;
        $imagesByReference = $reference->images()->get();
        $allow_sharing = Field::getSelectedValues("allow_sharing", $reference->store);
        $manufacturers = $reference->manufacturers;

        return view('front.references.single')
            ->with('reference', $reference)
            ->with('selected_products', $selected_products)
            ->with('datablock', $datablock)
            ->with('allow_sharing', $allow_sharing)
            ->with('manufacturers', $manufacturers)
            ->with('imagesByReference', $imagesByReference);
    }

    public function redirectToPluralshowStoresForBrand($id)
    {
        return redirect()->route('front_brand_stores', $id);
    }

    public function showStoresForBrand($id) {

        $manufacturer = Manufacturer::with('stores', 'brandreferences.category')->findOrFail($id);

        return view('front.brand.stores')
            ->with('manufacturer', $manufacturer);
    }

    public function brandReferencesIndex()
    {
        $brandreferences = BrandReference::with('category')->paginate(30);

        return view('front.brandreferences.index')
            ->with('brandreferences', $brandreferences);
    }

    public function showBrandReference($manufacturerId, $referenceId)
    {
        $manufacturer = Manufacturer::with('stores', 'brandreferences.category')->findOrFail($manufacturerId);
        $brandreference = BrandReference::findOrFail($referenceId);

        $storesCount = count($manufacturer->stores);
        $brandreferencesCount = count($manufacturer->brandreferences);

        return view('front.brand.references.references-single')
            ->with('storesCount', $storesCount)
            ->with('brandreferencesCount', $brandreferencesCount)
            ->with('brandreference', $brandreference);
    }

    public function showProducts()
    {
        $products = Product::with('references', 'manufacturer')->orderBy('id', 'desc')->get();
        $stores = Store::active()->get();
        $manufacturers = Manufacturer::orderBy('name', 'asc')->get();
        return view('front.products.list')
            ->with('products', $products)
            ->with('manufacturers', $manufacturers)
            ->with('stores', $stores);
    }

    public function showStores()
    {
        $categories = Category::all();

        $products = Product::all();
        $stores = Store::active()->with('references', 'location', 'profile.fields')->orderBy('store_name')->paginate(30);
        $manufacturers = Manufacturer::with('references', 'stores')->withCount('stores')->has('stores', '>', 0)->orderBy('name', 'asc')->get();
        $filter_locations = $this->locationRepository->getAndCountLocationsWithActiveStores();

        return view('front.stores.list')
            ->with('products', $products)
            ->with('manufacturers', $manufacturers)
            ->with('filter_locations', $filter_locations)
            ->with('categories', $categories)
            ->with('stores', $stores);
    }

}
