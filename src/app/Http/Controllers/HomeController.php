<?php

namespace App\Http\Controllers;

use App\Manufacturer;
use App\Product;
use App\Reference;
use App\Slide;
use Illuminate\View\View;

class HomeController extends BaseController
{
    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return View
     */
    public function contactPage()
    {
        return view('front.pages.contact');
    }

    /**
     * @return View
     */
    public function termsPage()
    {
        return view('front.pages.terms');
    }

    /**
     * @return View
     */
    public function privacyPage()
    {
        return view('front.pages.privacy');
    }

    /**
     * @return View
     */
    public function homepage()
    {
        $references_newest = Reference::active()->limit(6)->offset(0)->orderBy('id', 'desc')->get();
        $references_most = Reference::active()->limit(6)->offset(0)->orderBy('views', 'desc')->get();

        $products_most = Product::limit(6)->offset(0)->orderBy('views', 'desc')->get();
        $products_newest = Product::where('store_id', '!=', null)->where('manufacturer_id', '!=', null)->limit(6)->offset(0)->orderBy('id', 'desc')->get();

        $manufacturers = Manufacturer::where('featured', 1)->limit(6)->get();

        $slides = Slide::all();
        return view('front.index')
            ->with('references_most', $references_most)
            ->with('references_newest', $references_newest)
            ->with('products_newest', $products_newest)
            ->with('products_most', $products_most)
            ->with('manufacturers', $manufacturers)
            ->with('slides', $slides);
    }

    public function advertisementPage()
    {
        return view('front.pages.advertisement');
    }
}
