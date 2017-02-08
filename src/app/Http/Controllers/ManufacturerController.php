<?php

namespace App\Http\Controllers;

use App\Entity\Manufacturer\Repository as ManufacturerRepository;
use App\Manufacturer;
use Illuminate\Http\Request;

class ManufacturerController extends BaseController
{

    /**
     * The manufacturer repository instance.
     */
    protected $manufacturers;

    /**
     * ManufacturerController constructor.
     * @param ManufacturerRepository $manufacturers
     */
    public function __construct(ManufacturerRepository $manufacturers)
    {
        parent::__construct();
        $this->manufacturers = $manufacturers;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function insert(Request $request)
    {
        if ($this->manufacturers->saveNew($request))
            return back();
        else
            throw new \Exception("Something is not right", 400);
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function save(Request $request)
    {
        return $this->manufacturers->saveNew($request);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function viewAll()
    {
        return $this->manufacturers->getAll();
    }

    /**
     * @return mixed
     */
    public function viewAllFree()
    {
        $manufacturers = Manufacturer::where('manufacturer_group_id', null)->get();
        return $manufacturers;
    }

    /**
     * @param Manufacturer $manufacturer
     * @return mixed
     */
    public function view(Manufacturer $manufacturer)
    {
        return $this->manufacturers->get($manufacturer);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function edit(Request $request, Manufacturer $manufacturer)
    {
        return $this->manufacturers->update($request, $manufacturer);
    }

    /**
     * @param Manufacturer $manufacturer
     * @return mixed
     */
    public function delete(Manufacturer $manufacturer)
    {
        return $this->manufacturers->delete($manufacturer);
    }
}
