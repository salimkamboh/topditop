<?php

namespace App\Http\Controllers;

use App\Advert;
use App\Manufacturer;
use App\Models\MiscConfig;
use App\Services\EdenService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class VisionController extends BaseController
{
    public function index(Request $request)
    {
        $debug = $request->get("debug", 0);
        $take = $request->get("take", 1);
        return view('front.vision-index', compact('debug', 'take'));
    }
    public function search(Request $request, EdenService $edenService)
    {
        $file = request()->file('image');
        switch ($file->getClientOriginalExtension()) {
            case 'png':
                $ext = '.png';
                break;
            default:
            case 'jpg':
            case 'jpeg':
                $ext = '.jpg';
                break;
        }
        $generatedName  = uniqid() . $ext;
        $file->storeAs('temp', $generatedName);
        $url = asset('temp/' . $generatedName);
        Log::debug('url to search: ' . $url);
        $result = $edenService->searchImage($url);
        $debug = $request->get("debug", 0);
        if ($debug)
            return view('front.vision-result', compact('result'));
        $take = $request->get('take', 1);
        $min_score = MiscConfig::get('min_accepted_score', 80);
        $manufacturers = [];
        $i = 0;
        foreach ($result as $item) {
            if (++$i > $take || $item->score < $min_score)
                break;
            $advert = Advert::where('reference_image_url', 'full_size/' . $item->image_name)->first();
            if (!is_null($advert))
                $manufacturers[] = $advert->manufacturer_id;
        }
        return redirect()->route('default')->with('brand_filter', implode(', ', $manufacturers));
    }
}
