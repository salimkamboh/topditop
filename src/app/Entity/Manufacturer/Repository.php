<?php

namespace App\Entity\Manufacturer;

use App\Manufacturer;
use Illuminate\Contracts\Logging\Log;
use Illuminate\Http\Request;
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

        $manufacturer->name = $request->name;

        $imagePath = '/images/full_size/' . self::slugify($manufacturer->name) . '.jpg';
        $serverImageUrl = getcwd() . $imagePath;
        file_put_contents($serverImageUrl, base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $request->base64)));
        $imageUrlFull = URL::to('/') . $imagePath;
        $manufacturer->image_url = $imageUrlFull;

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
        //print_r($request->all());exit;

        $imagePath = '/images/full_size/' . self::slugify($manufacturer->name) . '.jpg';
        $serverImageUrl = getcwd() . $imagePath;
        file_put_contents($serverImageUrl, base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $request->base64)));
        $imageUrlFull = URL::to('/') . $imagePath;
        $manufacturer->image_url = $imageUrlFull;

        $manufacturer->save();
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
        $manufacturer->delete();
    }

}