<?php

namespace App\Http\Controllers;

use App\Advert;
use App\Entity\Advert\Repository as AdvertRepository;
use App\Http\Requests\Adverts\CreateAdvertRequest;
use App\Http\Requests\Adverts\Images\SetAdvertImageRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


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

    public function save(CreateAdvertRequest $request)
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

    public function setImage(Advert $advert, SetAdvertImageRequest $request)
    {
        return $this->adverts->setImage($advert, $request->base64, $request->type);
    }

}
