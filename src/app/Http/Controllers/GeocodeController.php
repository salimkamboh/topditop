<?php

namespace App\Http\Controllers;

use App\Services\GeocodeService;
use Illuminate\Http\Request;

use App\Http\Requests;

class GeocodeController extends Controller
{
    //
    /**
     * @var GeocodeService
     */
    private $service;


    /**
     * GeocodeController constructor.
     * @param GeocodeService $service
     */
    public function __construct(GeocodeService $service)
    {
        $this->service = $service;
    }

    public function find(Request $request)
    {
        $address = $request->get('address');

        $city = $this->service->geocode($address);

        return response()->json($city);
    }
}
