<?php

namespace App\Http\Controllers;

use App\Advert;
use App\Field;
use App\FieldGroup;
use App\Http\Requests;
use App\Location;
use App\Manufacturer;
use App\Product;
use App\Profile;
use App\Reference;
use App\Slide;
use App\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Ixudra\Curl\Facades\Curl;

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
    public function homepage()
    {
        $references_newest = Reference::where(['status' => '1'])->limit(6)->offset(0)->orderBy('id', 'desc')->get();
        $references_most = Reference::where(['status' => '1'])->limit(6)->offset(0)->orderBy('views', 'desc')->get();

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
