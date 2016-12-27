<?php

namespace App\Http\Controllers;

use App\FieldGroup;
use App\Package;
use Illuminate\Http\Request;

use App\Advert;
use App\Entity\Advert\Repository as AdvertRepository;


class AdvertController extends BaseController
{

    /**
     * @var AdvertRepository
     */
    protected $adverts;

    /**
     * AdvertController constructor.
     * @param AdvertRepository $adverts
     */
    public function __construct(AdvertRepository $adverts)
    {
        parent::__construct();
        $this->adverts = $adverts;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function viewAll()
    {
        return $this->adverts->getAll();
    }

    /**
     * @param Advert $advert
     * @return mixed
     */
    public function view(Advert $advert)
    {
        return $this->adverts->get($advert);
    }

    /**
     * @param Request $request
     * @param Advert $advert
     * @return Advert
     */
    public function edit(Request $request, Advert $advert)
    {
        return $this->adverts->update($request, $advert);
    }

    public function save(Request $request)
    {
        return $this->adverts->saveNew($request);
    }

    /**
     * @param Advert $advert
     * @return mixed
     */
    public function delete(Advert $advert)
    {
        return $this->adverts->delete($advert);
    }

}
