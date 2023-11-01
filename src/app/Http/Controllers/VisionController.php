<?php

namespace App\Http\Controllers;

use App\Services\EdenService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;


class VisionController extends BaseController
{
    public function index(EdenService $edenService)
    {
        return view('front.vision-index');
    }
    public function search(EdenService $edenService)
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
        $edenService->searchImage($url);
    }
}
