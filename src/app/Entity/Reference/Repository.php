<?php

namespace App\Entity\Reference;

use App\Helpers\PowerChecker;
use App\Helpers\VideoUrlHelper;
use App\Package;
use App\Product;
use App\Reference;
use App\Store;
use Illuminate\Http\Request;

class Repository extends PowerChecker
{

    /**
     * @param Request $request
     * @return Reference
     */
    public function create(Request $request, Store $store)
    {
        $reference = new Reference();

        $reference->title = $request->title;
        $reference->description = $request->description;
        $reference->video = $request->get('video', '');
        if ($reference->video) {
            $reference->video_html = VideoUrlHelper::parse($request->video);

            if(!$reference->video_html) {
                $request->session()->flash('fail', trans('messages.video_url_invalid'));
            }
        } else {
            $reference->video_html = '';
        }

        $reference->status = Reference::STATUS_PUBLISHED;
        $reference->save();

        $reference->store()->associate($store);
        $reference->addImages($request, $reference, false);
        $reference->addProducts($request, $reference, false);
        $reference->addBrands($request, $reference, false);
        $reference->update();

        return $reference;
    }

    /**
     * @param Reference $reference
     * @param Request $request
     * @return Reference
     */
    public function updateValues(Reference $reference, Request $request)
    {
        $reference->title = $request->title;
        $reference->description = $request->description;
        $reference->video = $request->get('video', '');
        if ($reference->video) {
            $reference->video_html = VideoUrlHelper::parse($request->video);

            if(!$reference->video_html) {
                $request->session()->flash('fail', trans('messages.video_url_invalid'));
            }
        } else {
            $reference->video_html = '';
        }

        $reference->addImages($request, $reference, true);
        $reference->addProducts($request, $reference, true);
        $reference->addBrands($request, $reference, true);

        $reference->update();
        return $reference;
    }

    /**
     * @param Request $request
     * @param Store $store
     * @return Reference|array
     */
    public function insert(Request $request, Store $store)
    {
        if ($limitation = $this->isLimited($request, 'reference')) {
            $response = array('code' => $limitation::DISK_FULL);
        } else {
            $reference = $this->create($request, $store);
            $response = [
                'code' => $reference::SUCCESS,
                'resourceId' => $reference->id
            ];
            $message = '';
            if ($store->package_name() != Package::HIGHEST) {
                $message = 'If you want to add description or a video, please upgrade your package to TopDiTop Store';
            }
            $request->session()->flash('success', 'Reference Saved. ' . $message);
        }
        return $response;
    }

    /**
     * @param Request $request
     * @param Reference $reference
     * @return array
     */
    public function update(Request $request, Reference $reference)
    {
        $this->updateValues($reference, $request);
        return [
            'code' => $reference::SUCCESS,
            'resourceId' => $reference->id
        ];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll()
    {
        return Reference::all();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAllImages(Reference $reference)
    {
        $images = [];
        foreach ($reference->images as $image) {
            $image->url = $image->getImageUrl();
            $images [] = $image;
        }
        return $images;
    }

    /**
     * @param Reference $reference
     * @return mixed
     */
    public function getAllProducts(Reference $reference)
    {
        $products = $reference->products;
        $arrayOfProds = array();
        foreach ($products as $product) {
            $arrayOfProds[] = $product->id;
        }

        return Product::with('images')->whereIn('id', $arrayOfProds)->get();
    }

    /**
     * @param Reference $reference
     * @return mixed
     */
    public function getAllManufacturers(Reference $reference)
    {
        return $reference->manufacturers;
    }

    /**
     * @param Reference $reference
     * @return mixed
     */
    public function get(Reference $reference)
    {
        return Reference::find($reference->id);
    }

    public function delete(Reference $reference)
    {
        $reference->images()->detach();
        $reference->manufacturers()->detach();
        $reference->products()->detach();
        $reference->delete();
    }

    /**
     * @param Reference $reference
     * @return mixed
     */
    public function retrieve(Reference $reference)
    {
        $reference->html = $reference->htmlTemplateDashboard();
        return $reference;
    }

    public function updateReferenceRest(Reference $reference, Request $request, $editMode)
    {
        $reference->title = $request->title;
        $reference->description = $request->description;
        $reference->video = $request->get('video', '');
        if ($reference->video) {
            $reference->video_html = VideoUrlHelper::parse($request->video);

            if(!$reference->video_html) {
                $request->session()->flash('fail', trans('messages.video_url_invalid'));
            }
        } else {
            $reference->video_html = '';
        }

        $reference->addProductsRest($request, $reference);
        $reference->addBrandsFromArray($request, $reference, $editMode);
        $reference->addImagesRest($request, $editMode);
        $reference->save();

        return $reference;
    }

    public function insertReferenceRest(Request $request, $editMode)
    {
        /** @var Store $store */
        $store = Store::find($request->store_id);
        $reference = new Reference();
        $reference->title = $request->title;
        $reference->description = $request->description;
        $reference->video = $request->get('video', '');
        if ($reference->video) {
            $reference->video_html = VideoUrlHelper::parse($request->video);

            if(!$reference->video_html) {
                $request->session()->flash('fail', trans('messages.video_url_invalid'));
            }
        } else {
            $reference->video_html = '';
        }

        $reference->save();

        $reference->store()->associate($store);
        $reference->addProductsRest($request, $reference);
        $reference->addBrandsFromArray($request, $reference, $editMode);
        $reference->addImagesRest($request, $editMode);
        $reference->save();

        return $reference;
    }
}