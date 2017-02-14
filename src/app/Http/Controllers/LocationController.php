<?php

namespace App\Http\Controllers;

use App\Entity\Location\Repository as LocationRepository;
use App\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LocationController extends BaseController
{
    /**
     * The fieldGroup repository instance.
     */
    protected $locations;

    /**
     * LocationController constructor.
     * @param LocationRepository $locations
     */
    public function __construct(LocationRepository $locations)
    {
        parent::__construct();
        $this->locations = $locations;
    }

    public function index()
    {
        $this->locations->listAll();
    }

    public function listEnhancedLocations()
    {
        return $this->locations->listEnhancedLocations();
    }

    public function showAll()
    {
        $locale = App::getLocale();
        return $this->locations->getAll($locale);
    }

    /**
     * @param Location $location
     * @return mixed
     */
    public function view(Location $location)
    {
        return $this->locations->get($location);
    }

    /**
     * @param Request $request
     * @param Location $location
     * @return Location
     */
    public function edit(Request $request, Location $location)
    {
        return $this->locations->update($request, $location);
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function save(Request $request)
    {
        return $this->locations->saveNew($request);
    }

    /**
     * @param Location $location
     * @return mixed
     */
    public function delete(Location $location)
    {
        return $this->locations->delete($location);
    }
}
