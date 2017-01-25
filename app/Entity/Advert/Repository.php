<?php

namespace App\Entity\Advert;

use App\Manufacturer;
use App\Store;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Advert;
use Illuminate\Support\Facades\Storage;
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
        $existingImageUrl = $advert->getAttribute($type . '_url');
        if ($existingImageUrl) {
            $this->deleteImageByUrl($existingImageUrl);
        }

        $fileName = 'image_' . uniqid() . '.jpg';
        $relativePath = '/full_size/' . $fileName;
        $imageBinary = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64_encoded_image));
        Storage::disk('images')->put($relativePath, $imageBinary);

        $imageUrlFull = URL::to('images') . $relativePath;
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

    /**
     * @param $existingImageUrl
     */
    private function deleteImageByUrl($existingImageUrl)
    {
        if (! str_contains($existingImageUrl, "/images/")) {
            return;
        }
        $messyRelativePath = parse_url($existingImageUrl, PHP_URL_PATH);
        $cleanRelativePath = str_replace('/topditop/images/', '/images/', $messyRelativePath);
        $cleanRelativePath = str_replace('/images/', '/', $cleanRelativePath);
        Storage::disk('images')->delete($cleanRelativePath);
    }

}