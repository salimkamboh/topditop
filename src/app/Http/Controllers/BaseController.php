<?php

namespace App\Http\Controllers;

use App\Location;
use App\Product;
use App\Registerfield;
use App\Store;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use View;

class BaseController extends Controller
{

    protected $current_store;
    protected $products_footer;
    protected $locations_footer;
    protected $stores_footer;

    public function __construct()
    {
        if (Auth::check()) {
            $user = Auth::user();
            if (!empty($user->store))
                $this->current_store = $user->store;
            else
                $this->current_store = Store::first();

        } else {
            $this->current_store = Store::find(1);
        }

        $this->products_footer = Product::limit(6)->offset(0)->get();
        $this->locations_footer = Location::popular()->get();
        $this->stores_footer = Store::active()->limit(10)->offset(0)->get();

        View::share('current_store', $this->current_store);
        View::share('products_footer', $this->products_footer);
        View::share('locations_footer', $this->locations_footer);
        View::share('stores_footer', $this->stores_footer);

        View::share('registerfields_firma', $this->getFormFields('Firma'));
        View::share('registerfields_ansprechpartner', $this->getFormFields('Ansprechpartner'));
        View::share('registerfields_service', $this->getFormFields('Service'));
        
        $locale = app()->getLocale();

        if ($locale == '')
            $locale = 'en';
        View::share('locale', $locale);
    }

    public function getFormFields($fieldLocation)
    {
        return Registerfield::where('fieldlocation', $fieldLocation)->orderBy('order', 'asc')->get();
    }
}