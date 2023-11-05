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
        // return redirect()->route('front_stores')->with('brand_filter', );

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

        // $url = "https://topditop.com/images/full_size/image_61e833b645a30.jpg";


        // Log::debug('url to search: ' . $url);
        // $result = $edenService->searchImage($url);
        $result = $this->fakeResults();
        $debug = $request->get("debug", 0);
        if ($debug)
            return view('front.vision-result', compact('result'));
        // $take = $request->get('take', 1);
        $min_score = MiscConfig::get('min_accepted_score', 80);
        $take = MiscConfig::get('take', 1);

        $manufacturers = [];
        $i = 0;
        // Log::debug(print_r($result['items'], true));
        if (!empty($result['items'])) {
            foreach ($result['items'] as $item) {
                // Log::debug(print_r($item, true) . ' i: ' . $i . ' take: ' . $take);
                if (++$i > $take || $item->score < $min_score)
                    break;
                $advert = Advert::where('reference_image_url', '/full_size/' . $item->image_name)->first();
                // Log::debug($advert->toArray());
                if (!is_null($advert)) {
                    $manufacturers[] = $advert->manufacturer_id;
                }
            }
        }
        // Log::debug("manufacturers: " . print_r($manufacturers, true));
        return redirect()->route('front_stores')->with('brand_filter', implode(',', $manufacturers));
    }
    private function fakeResults()
    {
        return
            [
                'items' => [
                    (object) [
                        'image_name' => 'image_6532579c2b4ed.jpg',
                        'score' => 96.9
                    ],
                    (object) [
                        'image_name' => 'image_63b5b05ec13cd.jpg',
                        'score' => 71.8
                    ],
                    (object) [
                        'image_name' => 'image_6532581d8f5e6.jpg',
                        'score' => 70.8
                    ],
                    (object) [
                        'image_name' => 'image_64675721d37a0.jpg',
                        'score' => 70.5
                    ],
                    (object) [
                        'image_name' => 'image_640f3a3037280.jpg',
                        'score' => 70.5
                    ],
                ]
            ];
    }
}
