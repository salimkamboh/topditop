<?php

namespace App\Http\Controllers;

use App\Advert;
use App\Entity\Advert\Repository as AdvertRepository;
use App\Events\AdvertImageWasSet;
use App\Http\Requests\Adverts\CreateAdvertRequest;
use App\Http\Requests\Adverts\Images\SetAdvertImageRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Event;


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
        $advert = $this->adverts->saveNew($request);

        return $advert;
    }

    /**
     * @param Advert $advert
     * @return Response
     */
    public function delete(Advert $advert)
    {
        $deleted = $this->adverts->delete($advert);

        if ($deleted) {
            return response()->json([], Response::HTTP_NO_CONTENT);
        }
        return response()->json([
            'error' => 'Failed to delete advert.',
        ], Response::HTTP_BAD_REQUEST);
    }

    public function setImage(Advert $advert, SetAdvertImageRequest $request)
    {
        $updatedAdvert = $this->adverts->setImage($advert, $request->base64, $request->type);

        Event::fire(new AdvertImageWasSet($updatedAdvert));

        return $updatedAdvert;
    }

}
