<?php

namespace App\Entity\Manufacturer;

use App\Manufacturer;
use Illuminate\Contracts\Logging\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class Repository
{
    /**
     * @param Request $request
     * @return Manufacturer
     */
    public function saveNew(Request $request)
    {
        $manufacturer = new Manufacturer($request->all());

        $manufacturer = $this->setImage($manufacturer, $request->base64);
        $manufacturer->save();

        return $manufacturer;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll()
    {
        return Manufacturer::all();
    }

    /**
     * @param Manufacturer $manufacturer
     * @return mixed
     */
    public function get(Manufacturer $manufacturer)
    {
        return Manufacturer::find($manufacturer->id);
    }

    /**
     * @param Request $request
     * @param Manufacturer $manufacturer
     * @return Manufacturer
     */
    public function update(Request $request, Manufacturer $manufacturer)
    {
        /** @var Manufacturer $manufacturer */
        $manufacturer = Manufacturer::find($manufacturer->id);
        $manufacturer->name = $request->name;
        $manufacturer->featured = $request->featured;

        $manufacturer = $this->setImage($manufacturer, $request->base64);
        $manufacturer->save();

        return $manufacturer;
    }

    public function setImage(Manufacturer $manufacturer, $base64_encoded_image)
    {
        if (! $base64_encoded_image) {
            $manufacturer->image_url = '';
            return $manufacturer;
        }
        $fileName = 'manufacturer_' . str_random(6) . '_'. str_slug($manufacturer->name) . '.jpg';
        $relativePath = 'full_size/' . $fileName;
        $imageBinary = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64_encoded_image));
        Storage::disk('images')->put($relativePath, $imageBinary);
        $manufacturer->image_url = '/images/' . $relativePath;

        return $manufacturer;
    }

    static public function slugify($text)
    {
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, '-');

        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }

    /**
     * @param Manufacturer $manufacturer
     */
    public function delete(Manufacturer $manufacturer)
    {
        if ($manufacturer->image_url) {
            $this->deleteImageByUrl($manufacturer->image_url);
        }
        $manufacturer->delete();
    }

    /**
     * @param $existingImageUrl
     */
    private function deleteImageByUrl($existingImageUrl)
    {
        if (! str_contains($existingImageUrl, '/images/')) {
            return;
        }
        $messyRelativePath = parse_url($existingImageUrl, PHP_URL_PATH);
        $cleanRelativePath = str_replace('/topditop/images/', '/images/', $messyRelativePath);
        $cleanRelativePath = str_replace('/images/', '/', $cleanRelativePath);
        Storage::disk('images')->delete($cleanRelativePath);
    }

}