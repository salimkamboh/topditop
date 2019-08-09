<?php

namespace App\Entity\Store;

use App\Field;
use App\FieldProfile;
use App\Manufacturer;
use App\Reference;
use App\Store;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class Repository
{
    /**
     * @param Store $store
     * @return array
     */
    public function getStoreData(Store $store)
    {
        $datablock = array();
        $datablock["topditop_offer"] = array_filter(explode(",", Field::getSelectedValues("topditop_offer", $store)));
        $datablock["TopDiTop_Service"] = array_filter(explode(",", Field::getSelectedValues("TopDiTop_Service", $store)));
        $datablock["categories"] = $store->getCategoriesNiceArray();
        $datablock["description"] = Field::getSelectedValues("description", $store);
        $datablock["address"] = Field::getSelectedValues("address", $store);

        $datablock["from_working_days"] = Field::getSelectedValues("from_working_days", $store);
        $datablock["to_working_days"] = Field::getSelectedValues("to_working_days", $store);
        $datablock["from_weekends"] = Field::getSelectedValues("from_weekends", $store);
        $datablock["to_weekends"] = Field::getSelectedValues("to_weekends", $store);
        $datablock["postal_code"] = Field::getSelectedValues("postal_code", $store);

        $datablock["philosophy"] = Field::getSelectedValues("philosophy", $store);
        $datablock["quotation"] = Field::getSelectedValues("quotation", $store);
        $datablock["owner"] = Field::getSelectedValues("owner", $store);
        $datablock["contact_mail"] = Field::getSelectedValues("contact_mail", $store);
        $datablock["website"] = Field::getSelectedValues("website", $store);
        $datablock["telephone_number"] = Field::getSelectedValues("telephone_number", $store);

        $datablock["store_longitude"] = Field::getSelectedValues("store_longitude", $store);
        $datablock["store_latitude"] = Field::getSelectedValues("store_latitude", $store);

        $datablock["newest_brand"] = Field::getSelectedValues("newest_brand", $store);
        $datablock["longest_brand"] = Field::getSelectedValues("longest_brand", $store);

        $datablock["newsletter_key_1"] = Field::getSelectedValues("newsletter_key_1", $store);
        $datablock["newsletter_key_2"] = Field::getSelectedValues("newsletter_key_2", $store);

        $datablock["add-new-architect"] = Field::getSelectedValues("add-new-architect", $store);

        return $datablock;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function multiFilter(Request $request)
    {
        $searchObject = $request->searchObject;
        $collection = new Collection();

        if (isset($searchObject['locationParams'])) {
            $locationParams = $searchObject['locationParams'];
            $stores = Store::whereIn('location_id', $locationParams)->with('image')->with('slide')->get();

            foreach ($stores as $store) {
                $store->numberReferences = $store->getNumberOfReferences();
                $store->categories = $store->getCategoriesNice();
                $collection->add($store);
            }
        }

        if (isset($searchObject['categoriesParams'])) {
            $catParams = $searchObject["categoriesParams"];

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
                $store->numberReferences = $store->getNumberOfReferences();
                $store->categories = $store->getCategoriesNice();
                if (!$collection->contains($store))
                    $collection->add($store);
            }

            return $collection;
        }

        if (isset($searchObject['brandParams'])) {
            $brandParams = $searchObject['brandParams'];

            $store_ids = array();
            foreach ($brandParams as $brandParam) {
                /** @var Manufacturer $manufacturer */
                $manufacturer = Manufacturer::find($brandParam);//->get();
                $references = $manufacturer->references()->get();

                foreach ($references as $reference) {
                    $store = $reference->store;
                    if (!in_array($store->id, $store_ids)) {
                        $store_ids[] = $store->id;
                    }
                }
            }
            $stores = Store::whereIn('id', $store_ids)->with('image')->get();
            foreach ($stores as $store) {
                $store->numberReferences = $store->getNumberOfReferences();
                $store->categories = $store->getCategoriesNice();
                if (!$collection->contains($store))
                    $collection->add($store);
            }
        }

        if (!isset($request->searchObject)) {
            $stores = Store::with('image')->get();
            foreach ($stores as $store_item) {
                $store_item->numberReferences = $store_item->getNumberOfReferences();
                $store_item->categories = $store_item->getCategoriesNice();
                $collection->add($store_item);
            }
        }

        return $collection;
    }

    public function multiFilterReferences(Request $request)
    {
        $searchObject = $request->searchObject;
        $collection = new Collection();

        if (isset($searchObject['brandParams'])) {
            $brandParams = $searchObject['brandParams'];
            $manufacturers = Manufacturer::with('references')->whereIn('id', $brandParams)->get();

            foreach ($manufacturers as $manufacturer) {
                foreach ($manufacturer->references as $reference) {
                    $reference->image = $reference->getImageByThumb('reference_thumb');
                    $reference->package_name = $reference->package_name();
                    $reference->store_name = $reference->store->store_name;
                    $reference->date = $reference->getNiceDate();
                    $reference->numImages = $reference->getNumberOfImages();
                    if (!$collection->contains($reference))
                        $collection->add($reference);
                }
            }
        }
        if (isset($searchObject['storeParams'])) {

            $storeParams = $searchObject['storeParams'];
            $referencesByStores = Reference::whereIn('store_id', $storeParams)->get();

            foreach ($referencesByStores as $reference) {
                $reference->image = $reference->getImageByThumb('reference_thumb');
                $reference->package_name = $reference->package_name();
                $reference->store_name = $reference->store->store_name;
                $reference->date = $reference->getNiceDate();
                $reference->numImages = $reference->getNumberOfImages();
                if (!$collection->contains($reference))
                    $collection->add($reference);
            }
        }

        return $collection;
    }

    public function multiFilterReferencesGallery(Request $request, Store $store)
    {
        $collection = new Collection();

        if (isset($request->searchObject)) {
            $searchObject = $request->searchObject;
            if (isset($searchObject['brandParams'])) {
                $brandParams = $searchObject['brandParams'];
                $manufacturers = Manufacturer::with('references')->whereIn('id', $brandParams)->get();

                foreach ($manufacturers as $manufacturer) {
                    foreach ($manufacturer->references as $reference) {
                        $reference->image = $reference->getImageByThumb('reference_thumb');
                        $reference->package_name = $reference->package_name();
                        $reference->store_name = $reference->store->store_name;
                        $reference->date = $reference->getNiceDate();
                        $reference->numImages = $reference->getNumberOfImages();
                        if (!$collection->contains($reference) && $reference->store->id == $store->id && $reference->status == 1) {
                            $collection->add($reference);
                        }
                    }
                }
            }
        } else {
            $references_newest = Reference::where(['status' => '1', 'store_id' => $store->id])->limit(12)->offset(0)->orderBy('id', 'desc')->get();

            foreach ($references_newest as $reference) {
                $reference->image = $reference->getImageByThumb('reference_thumb');
                $reference->package_name = $reference->package_name();
                $reference->store_name = $reference->store->store_name;
                $reference->date = $reference->getNiceDate();
                $reference->numImages = $reference->getNumberOfImages();
                if (!$collection->contains($reference))
                    $collection->add($reference);
            }
        }

        return $collection;
    }
}
