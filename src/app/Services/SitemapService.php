<?php

namespace App\Services;

use App\Product;
use App\Reference;
use App\Store;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;

class SitemapService
{
    public function create()
    {
        $sitemap = App::make('sitemap');

        $sitemap->add(url('/'), Carbon::now(), '1.0', 'weekly');
        $sitemap->add(route('front_contact_page'), Carbon::now(), '0.8', 'monthly');

        $this->allProducts($sitemap);
        $this->allReferences($sitemap);
        $this->allStores($sitemap);

        $sitemap->store('xml', 'sitemap');

        return $sitemap;
    }

    private function allProducts($sitemap)
    {
        $sitemap->add(route('front_products'), Carbon::now(), '0.8', 'weekly');
        $products = Product::all();
        foreach ($products as $product) {
            $sitemap->add(route('front_show_product', $product->id), Carbon::now(), '0.8', 'weekly');
        }
    }

    private function allReferences($sitemap)
    {
        $sitemap->add(route('front_references'), Carbon::now(), '0.8', 'weekly');
        $references = Reference::all();
        foreach ($references as $reference) {
            $sitemap->add(route('front_references_single', $reference->id), Carbon::now(), '0.8', 'weekly');
        }
    }

    public function allStores($sitemap)
    {
        $sitemap->add(route('front_stores'), Carbon::now(), '0.8', 'weekly');
        $stores = Store::active()->get();
        foreach ($stores as $store) {
            $sitemap->add(route('front_show_store', $store->id), Carbon::now(), '0.8', 'weekly');
        }
    }
}