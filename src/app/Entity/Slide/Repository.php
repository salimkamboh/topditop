<?php

namespace App\Entity\Slide;

use App\Store;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Slide;
use Illuminate\Support\Facades\URL;

class Repository
{
    /**
     * @param Request $request
     * @return Slide
     */
    public function saveNew(Request $request)
    {
        $slide = new Slide();

        $slide->slot1_store_id = $request->slot1_store_id;
        $slide->slot2_store_id = $request->slot2_store_id;
        $slide->slot3_store_id = $request->slot3_store_id;
        $slide->slot4_store_id = $request->slot4_store_id;
        $slide->slot5_store_id = $request->slot5_store_id;

        $slide->slot1_width = $request->slot1_width;
        $slide->slot2_width = $request->slot2_width;
        $slide->slot3_width = $request->slot3_width;
        $slide->slot4_width = $request->slot4_width;
        $slide->slot5_width = $request->slot5_width;

        $slide->slot1_valid_until = $request->slot1_valid_until;
        $slide->slot2_valid_until = $request->slot2_valid_until;
        $slide->slot3_valid_until = $request->slot3_valid_until;
        $slide->slot4_valid_until = $request->slot4_valid_until;
        $slide->slot5_valid_until = $request->slot5_valid_until;

        $slide->title = $request->title;

        $slide_name = $request->title;

        $imagePath = '/images/full_size/' . self::slugify($slide_name) . '.jpg';
        $serverImageUrl = getcwd() . $imagePath;
        file_put_contents($serverImageUrl, base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $request->base64)));
        $imageUrlFull = URL::to('/') . $imagePath;
        $slide->image_url = $imageUrlFull;

        $slide->save();
        return $slide;
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
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll()
    {
        return Slide::all();
    }

    /**
     * @param Slide $slide
     * @return mixed
     */
    public function get(Slide $slide)
    {
        return Slide::find($slide->id);
    }

    /**
     * @param Request $request
     * @param Slide $slide
     * @return Slide
     */
    public function update(Request $request, Slide $slide)
    {
        $slide->slot1_store_id = $request->slot1_store_id;
        $slide->slot2_store_id = $request->slot2_store_id;
        $slide->slot3_store_id = $request->slot3_store_id;
        $slide->slot4_store_id = $request->slot4_store_id;
        $slide->slot5_store_id = $request->slot5_store_id;

        $slide->slot1_width = $request->slot1_width;
        $slide->slot2_width = $request->slot2_width;
        $slide->slot3_width = $request->slot3_width;
        $slide->slot4_width = $request->slot4_width;
        $slide->slot5_width = $request->slot5_width;

        $slide->slot1_valid_until = $request->slot1_valid_until;
        $slide->slot2_valid_until = $request->slot2_valid_until;
        $slide->slot3_valid_until = $request->slot3_valid_until;
        $slide->slot4_valid_until = $request->slot4_valid_until;
        $slide->slot5_valid_until = $request->slot5_valid_until;

        $slide->title = $request->title;
        if (isset($request->base64)) {
            $slide_name = $request->title;

            $imagePath = '/images/full_size/' . self::slugify($slide_name) . uniqid() . '.jpg';
            $serverImageUrl = getcwd() . $imagePath;
            file_put_contents($serverImageUrl, base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $request->base64)));
            $imageUrlFull = URL::to('/') . $imagePath;
            $slide->image_url = $imageUrlFull;
        }
        $slide->save();
        return $slide;
    }

}