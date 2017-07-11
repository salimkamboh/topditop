<?php

namespace App\Http\Controllers;

use App\Manufacturer;
use App\Package;
use App\Product;
use App\Reference;
use Illuminate\Database\Eloquent\Collection;

class AdminController extends BaseController
{

    public function admin()
    {
        return view('auth.admin.home');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminReferences()
    {
        $references = Reference::all();
        return view('auth.admin.dashboard.references.list')
            ->with('references', $references);
    }

    public function editReference(Reference $reference)
    {

        $manufacturers = Manufacturer::all();
        $selected_images = Reference::find($reference->id)->images()->get();
        $selected_products = Reference::find($reference->id)->products()->get();

        $forbidden = array();
        foreach ($selected_products as $selected_product) {
            $forbidden[] = $selected_product->id;
        }

        /** @var Collection $availableProducts */
        $availableProducts = Product::with('references')->whereNotIn('id', $forbidden)->get();
        $collection = new Collection();

        /** @var Product $availableProduct */
        foreach ($availableProducts as $availableProduct) {
            if ($availableProduct->store->id == $reference->store->id) {
                $collection->add($availableProduct);
            }
        }

        if ($reference->store->package_name() == Package::HIGHEST) {
            $allowed_images = 7;
        } else if ($reference->store->package_name() == Package::MIDDLE) {
            $allowed_images = 1;
        } else {
            $allowed_images = 0;
        }

        return view('auth.admin.dashboard.references.single-reference')
            ->with('reference', $reference)
            ->with('availableProducts', $collection)
            ->with('manufacturers', $manufacturers)
            ->with('selected_products', $selected_products)
            ->with('allowed_images', $allowed_images)
            ->with('selected_images', $selected_images);
    }
}