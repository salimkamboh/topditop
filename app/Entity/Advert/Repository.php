<?php

namespace App\Entity\Advert;

use App\Manufacturer;
use App\Store;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Advert;
use Illuminate\Support\Facades\URL;

class Repository
{
    /**
     * @param Request $request
     * @return Advert
     */
    public function saveNew(Request $request)
    {
        $advert = new Advert();

        if (isset($request->filename_brand_logo_url_base64)) {
            $slide_name = 'image_' . uniqid();

            $imagePath = '/images/full_size/' . $slide_name . '.jpg';
            $serverImageUrl = getcwd() . $imagePath;
            file_put_contents($serverImageUrl, base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $request->filename_brand_logo_url_base64)));
            $imageUrlFull = URL::to('/') . $imagePath;
            $advert->brand_logo_url = $imageUrlFull;
        }

        if (isset($request->filename_reference_image_url_base64)) {
            $slide_name = 'image_' . uniqid();

            $imagePath = '/images/full_size/' . $slide_name . '.jpg';
            $serverImageUrl = getcwd() . $imagePath;
            file_put_contents($serverImageUrl, base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $request->filename_reference_image_url_base64)));
            $imageUrlFull = URL::to('/') . $imagePath;
            $advert->reference_image_url = $imageUrlFull;
        }

        if (isset($request->filename_scanned_image_url_base64)) {
            $slide_name = 'image_' . uniqid();

            $imagePath = '/images/full_size/' . $slide_name . '.jpg';
            $serverImageUrl = getcwd() . $imagePath;
            file_put_contents($serverImageUrl, base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $request->filename_scanned_image_url_base64)));
            $imageUrlFull = URL::to('/') . $imagePath;
            $advert->scanned_image_url = $imageUrlFull;
        }

        $brand = Manufacturer::find($request->manufacturer_id);
        $advert->manufacturer()->associate($brand);
        if (isset($request->name)) {
            $advert->name = $request->name;
        }
        $advert->save();
        return $advert;
    }


    /**
     * TODO: implement image file cleanup from disk if property is not null
     *
     * @param Advert $advert
     * @param $base64_encoded_image
     * @param $type
     * @return Advert
     */
    public function setImage(Advert $advert, $base64_encoded_image, $type)
    {
        $slide_name = 'image_' . uniqid();
        $imagePath = '/images/full_size/' . $slide_name . '.jpg';
        $serverImageUrl = getcwd() . $imagePath;
        file_put_contents($serverImageUrl, base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64_encoded_image)));
        $imageUrlFull = URL::to('/') . $imagePath;
        $advert->setAttribute($type . '_url', $imageUrlFull);
        $advert->save();
        return $advert;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll()
    {
        return Advert::all();
    }

    /**
     * @param Advert $advert
     * @return mixed
     */
    public function get(Advert $advert)
    {
        return Advert::find($advert->id);
    }

    /**
     * @param Request $request
     * @param Advert $advert
     * @return Advert
     */
    public function update(Request $request, Advert $advert)
    {
        if (isset($request->filename_brand_logo_url_base64)) {
            $slide_name = 'image_' . uniqid();

            $imagePath = '/images/full_size/' . $slide_name . '.jpg';
            $serverImageUrl = getcwd() . $imagePath;
            file_put_contents($serverImageUrl, base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $request->filename_brand_logo_url_base64)));
            $imageUrlFull = URL::to('/') . $imagePath;
            $advert->brand_logo_url = $imageUrlFull;
        }

        if (isset($request->filename_reference_image_url_base64)) {
            $slide_name = 'image_' . uniqid();

            $imagePath = '/images/full_size/' . $slide_name . '.jpg';
            $serverImageUrl = getcwd() . $imagePath;
            file_put_contents($serverImageUrl, base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $request->filename_reference_image_url_base64)));
            $imageUrlFull = URL::to('/') . $imagePath;
            $advert->reference_image_url = $imageUrlFull;
        }

        if (isset($request->filename_scanned_image_url_base64)) {
            $slide_name = 'image_' . uniqid();

            $imagePath = '/images/full_size/' . $slide_name . '.jpg';
            $serverImageUrl = getcwd() . $imagePath;
            file_put_contents($serverImageUrl, base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $request->filename_scanned_image_url_base64)));
            $imageUrlFull = URL::to('/') . $imagePath;
            $advert->scanned_image_url = $imageUrlFull;
        }
        $brand = Manufacturer::find($request->manufacturer_id);
        $advert->manufacturer()->associate($brand);
        if (isset($request->name)) {
            $advert->name = $request->name;
        }
        $advert->update();
        return $advert;
    }

    /**
     * @param Advert $advert
     */
    public function delete(Advert $advert)
    {
        $advert->delete();
    }

}