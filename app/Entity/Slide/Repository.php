<?php

namespace App\Entity\Slide;

use App\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        $slide->save();

        $slide = $this->setImage($slide, $request->base64);
        $slide->save();

        return $slide;
    }

    public function setImage(Slide $slide, $base64_encoded_image)
    {
        if (! $base64_encoded_image) {
            $slide->image_url = '';
            return $slide;
        }
        $fileName = 'slide_' . str_random(6) . '_'. str_slug($slide->title) . '.jpg';
        $relativePath = 'full_size/' . $fileName;
        $imageBinary = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64_encoded_image));
        Storage::disk('images')->put($relativePath, $imageBinary);
        $slide->image_url = '/images/' . $relativePath;

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
            if ($slide->image_url) {
                $this->deleteImageByUrl($slide->image_url);
            }
            $this->setImage($slide, $request->base64);
        }

        $slide->save();

        return $slide;
    }

    public function delete(Slide $slide)
    {
        if ($slide->image_url) {
            $this->deleteImageByUrl($slide->image_url);
        }
        $slide->delete();
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