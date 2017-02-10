<?php

namespace App\Entity\Product;

use App\Helpers\PowerChecker;
use App\Image;
use App\Product;
use App\Reference;
use App\Store;
use DB;
use Illuminate\Http\Request;

class Repository extends PowerChecker
{

    /**
     * @param Request $request
     * @param Store $store
     * @return Product
     */
    public function create(Request $request, Store $store)
    {
        $product = new Product();
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->save();
        $product->store()->associate($store);
        $product->addImages($request, $product, false);
        $product->addBrand($request, $product, false);
        $product->addReferences($request, $product, false);
        $product->addCategories($request, $product, false);
        $product->update();
        return $product;
    }

    /**
     * @param Request $request
     * @param Store $store
     * @return Reference|array
     */
    public function insert(Request $request, Store $store)
    {
        if ($limitation = $this->isLimited($request, 'product')) {
            $response = array('code' => $limitation::DISK_FULL);
        } else {
            $product = $this->create($request, $store);
            $response = [
                'code' => $product::SUCCESS,
                'resourceId' => $product->id
            ];
            if ($response['code'] == 200) {
                $request->session()->flash('success', trans('messages.product_created'));
            } else {
                $request->session()->flash('fail', trans('messages.product_create_failed'));
            }
        }

        return $response;
    }

    /**
     * @param Product $product
     * @param Request $request
     * @return Product
     */
    public function updateValues(Product $product, Request $request)
    {
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->addImages($request, $product, true);
        $product->addBrand($request, $product, true);
        $product->addReferences($request, $product, true);
        $product->addCategories($request, $product, true);
        $product->update();
        return $product;
    }

    /**
     * @param Request $request
     * @param Product $product
     * @return array
     */
    public function update(Request $request, Product $product)
    {
        $this->updateValues($product, $request);
        $response = [
            'code' => $product::SUCCESS,
            'resourceId' => $product->id
        ];
        if ($response['code'] == 200) {
            $request->session()->flash('success', trans('messages.product_updated'));
        } else {
            $request->session()->flash('fail', trans('messages.product_update_failed'));
        }
        return $response;
    }

    /**
     * @param array $_product
     * @return mixed
     */
    public function isNew($_product, $store)
    {

        $existsQuery = DB::table('products')
            ->where('mag_product_id', '=', $_product["product_id"])
            ->where('store_id', '=', $store->id)
            ->get();

        if (empty($existsQuery)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $_product
     */
    public function insertProd($_product, $store, $contract)
    {
        $product = new Product();
        $product->title = $_product["name"];
        $product->description = $_product["description"];
        $product->news_from_date = $_product["news_from_date"];
        $product->news_to_date = $_product["news_to_date"];
        $product->url_key = $_product["url_key"];
        $product->category_ids = $_product["category_ids"][0];
        $product->short_description = $_product["short_description"];
        $product->weight = $_product["weight"];
        $product->country_of_manufacture = " ";
        $product->price = $_product["price"];
        $product->mag_product_id = $_product["product_id"];

        $imageFile = $contract->getProductImage($_product["product_id"]);

        if (!empty($imageFile[0]["url"])) {
            $image = new Image();
            $image->name = $_product["name"];
            $image->url = $imageFile[0]["url"];
            $image->title = $store->store_name;
            $image->save();
            $product->image()->associate($image);
        }

        $product->store()->associate($store);
        $product->save();
    }

    /**
     * @param Product $product
     * @return Product
     */
    public function retrieveRest(Product $product)
    {
        $product->productImage = $product->getImageByThumb('reference_thumb');
        $product->categoriesNice = $product->getCategoriesNice();
        return $product;
    }

    /**
     * @param Product $product
     * @return Product
     */
    public function retrieve(Product $product)
    {

        $product->incrementViews();
        $product->html = $product->htmlTemplateDashboard();
        $product->productImage = $product->getImageByThumb('reference_thumb');
        $product->categoriesNice = $product->getCategoriesNice();
        $product->refImages = $product->getProdRefImages();
        $product->refId = $product->getProdRefId();
        return $product;
    }

    public function delete(Product $product)
    {
        $request = new Request();
        $request->productId = $product->id;
        $product->images()->detach();
        $product->manufacturer()->dissociate();
        $product->references()->detach();
        $product->delete();
    }

    public function viewAll()
    {
        return Product::all();
    }

    /**
     * @param Product $product
     * @return mixed
     */
    public function getAllReferences(Product $product)
    {
        $references = $product->references;
        $arrayOfRefs = array();
        foreach ($references as $reference) {
            $arrayOfRefs [] = $reference->id;
        }

        return Reference::whereIn('id', $arrayOfRefs)->get();
    }

    /**
     * @param Product $product
     * @return mixed
     */
    public function getAllCategories(Product $product)
    {
        return $product->categories;
    }


    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAllImages(Product $product)
    {
        $images = [];
        foreach ($product->images as $image) {
            $image->url = $image->getImageUrl();
            $images [] = $image;
        }
        return $images;
    }

    /**
     * @param $request
     * @param $editMode
     * @return Product
     */
    public function insertProductRest($request, $editMode)
    {
        /** @var Store $store */
        $store = Store::find($request->store_id);
        $product = new Product();
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;

        $product->save();

        $product->store()->associate($store);
        $product->addReferencesRest($request, $editMode);
        $product->addCategoriesRest($request, $editMode);
        $product->addBrandRest($request, $product, $editMode);
        $product->addImagesRest($request, $editMode);
        $product->save();

        return $product;
    }

    /**
     * @param Product $product
     * @param Request $request
     * @param $editMode
     * @return Product
     */
    public function updateProductRest(Product $product, Request $request, $editMode)
    {
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;

        /** @var Store $store */
        $store = Store::find($request->store_id);
        $product->store()->associate($store);

        $product->addReferencesRest($request, $product);
        $product->addCategoriesRest($request, $editMode);
        $product->addBrandRest($request, $product, $editMode);
        $product->addImagesRest($request, $editMode);
        $product->save();

        return $product;
    }


}