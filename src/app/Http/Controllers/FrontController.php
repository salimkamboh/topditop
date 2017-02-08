<?php

namespace App\Http\Controllers;

use App\Advert;
use App\Entity\Store\Repository as StoreRepository;
use App\Field;
use App\Location;
use App\Manufacturer;
use App\Package;
use App\Product;
use App\Reference;
use App\Store;
use DB;
use Illuminate\Http\Request;

class FrontController extends BaseController
{

    private $settingsRepository;

    /**
     * FrontController constructor.
     * @param StoreRepository $settingsRepository
     */
    public function __construct(StoreRepository $settingsRepository)
    {
        parent::__construct();
        $this->settingsRepository = $settingsRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function contactPage()
    {
        return view('front.pages.contact');
    }

    public function advertisementShow(Advert $advert, Request $request)
    {
        $latitude = $request->has('latitude') ? $request->get('latitude') : config('advertisement.fallback_latitude');
        $longitude = $request->has('longitude') ? $request->get('longitude') : config('advertisement.fallback_longitude');

        $params = array($latitude, $longitude);
        $allStoreLocations = $advert->getAllLocationsOfStores(app()->getLocale(), $advert->manufacturer->name);

        $locationsMatch = $advert->getCloseLocations($allStoreLocations, $params);
        $storeArray = current($locationsMatch);
        $closestStore = Store::find($storeArray[2]);

        return redirect()->route('front_show_store', ['id' => $closestStore->id]);
    }

    public function array_contains($itemsNew, $insertItem)
    {
        foreach ($itemsNew as $item) {
            if ($item->store_id == $insertItem->store_id && $item->key == $insertItem->key) {
                return true;
            }
        }
        return false;
    }


    /**
     * @param Store $store
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function frontShowStore(Store $store)
    {
        $manufacturers = $store->manufacturers;
        $datablock = $this->settingsRepository->getStoreData($store);

        $references_newest = Reference::active()->where('store_id', $store->id)->limit(12)->offset(0)->orderBy('id', 'desc')->get();
        $references_most = Reference::active()->where('store_id', $store->id)->limit(12)->offset(0)->orderBy('views', 'desc')->get();

        $products_newest = Product::where(['store_id' => $store->id])->limit(6)->offset(0)->orderBy('id', 'desc')->get();
        $products_most = Product::where(['store_id' => $store->id])->limit(6)->offset(0)->orderBy('views', 'desc')->get();

        $architects = explode(',', $datablock["add-new-architect"]);
        array_pop($architects);

        return view('front.stores.single')
            ->with('store', $store)
            ->with('references_newest', $references_newest)
            ->with('references_most', $references_most)
            ->with('manufacturers', $manufacturers)
            ->with('products_newest', $products_newest)
            ->with('products_most', $products_most)
            ->with('architects', $architects)
            ->with('datablock', $datablock);
    }

    public function frontShowStoresLocation(Location $location)
    {
        $fieldsOneStopShop = Field::getAllValues('onestopshop');
        $stores = Store::where('status', '=' , 1)->where('location_id', '=', $location->id)->get();
        $products = Product::all();
        $manufacturers = Manufacturer::all();
        $filter_locations = Location::all();
        return view('front.stores.list-search-results')
            ->with('products', $products)
            ->with('filter_locations', $filter_locations)
            ->with('manufacturers', $manufacturers)
            ->with('fieldsOneStopShop', $fieldsOneStopShop)
            ->with('stores', $stores);
    }

    public function frontShowResults(Request $request)
    {

        $fieldsOneStopShop = Field::getAllValues('onestopshop');
        $stores = Store::where('store_name', 'LIKE', '%' . $request->search_store . '%')->where('status', '=' , 1)->get();
        $products = Product::all();
        $manufacturers = Manufacturer::all();
        $filter_locations = Location::all();
        return view('front.stores.list-search-results')
            ->with('products', $products)
            ->with('filter_locations', $filter_locations)
            ->with('manufacturers', $manufacturers)
            ->with('fieldsOneStopShop', $fieldsOneStopShop)
            ->with('stores', $stores);
    }

    public function showReferences()
    {
        $references = Reference::active()->get();
        $stores = Store::active()->get();
        $manufacturers = Manufacturer::all();
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
        $manufacturers = Manufacturer::all();
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

        $datablock = $this->settingsRepository->getStoreData($this->current_store);
        $selected_products = Reference::find($reference->id)->products()->get();
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

    public function showProducts()
    {
        $products = Product::orderBy('id', 'desc')->get();
        $stores = Store::active()->get();
        $manufacturers = Manufacturer::all();
        return view('front.products.list')
            ->with('products', $products)
            ->with('manufacturers', $manufacturers)
            ->with('manufacturers', $manufacturers)
            ->with('stores', $stores);
    }

    public function showStores()
    {

        $fieldsOneStopShop = Field::getAllValues('onestopshop');

        $products = Product::all();
        $stores = Store::active()->get();
        $manufacturers = Manufacturer::all();
        $filter_locations = Location::all();
        return view('front.stores.list')
            ->with('products', $products)
            ->with('manufacturers', $manufacturers)
            ->with('filter_locations', $filter_locations)
            ->with('fieldsOneStopShop', $fieldsOneStopShop)
            ->with('stores', $stores);
    }


    public function adTest(Advert $advert, $latitude, $longitude)
    {

        $params = array($latitude, $longitude);
        //$allStoreLocations = $advert->getAllLocationsOfStores(, $advert->manufacturer->name);
        $locale = app()->getLocale();
        $brandName = $advert->manufacturer->name;

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

}