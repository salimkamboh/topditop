<?php

namespace App\Entity\Image;

use App\Product;
use App\Reference;
use App\Thumbnail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use App\Image;

class ImageRepository
{
    /**
     * @param $form_data
     * @return mixed
     */
    public function upload($form_data)
    {
        if(!$this->isFileUploadRequestValid()) {
            return Response::json([
                'error' => true,
                'message' => "File is too big.",
                'code' => 400
            ], 400);
        }


        $validator = Validator::make($form_data, Image::$rules, Image::$messages);

        if ($validator->fails()) {
            return Response::json([
                'error' => true,
                'message' => $validator->messages()->first(),
                'code' => 400
            ], 400);
        }

        $photo = $form_data['file'];

        $originalName = $photo->getClientOriginalName();
        $extension = $photo->getClientOriginalExtension();
        $originalNameWithoutExt = substr($originalName, 0, strlen($originalName) - strlen($extension) - 1);

        $filename = $this->sanitize($originalNameWithoutExt);
        $allowed_filename = $this->createUniqueFilename($filename, $extension);

        $image_info = getimagesize($_FILES['file']['tmp_name']);
        $image_width = $image_info[0];
        $image_height = $image_info[1];

        $max_mpx = 9;
        $max_px = $max_mpx * 1000 * 1000;

        if ($image_width * $image_height > $max_px) {
            return Response::json([
                'error' => true,
                'message' => "Image bigger than {$max_mpx}Mpx.",
                'code' => 400
            ], 400);
        }

        $sessionImage = new Image;

        if ($this->original($photo, $allowed_filename)) {
            $sessionImage->title = $allowed_filename;
            $sessionImage->name = $originalName;
            $sessionImage->url = URL::to('/') . '/images/full_size/' . $allowed_filename;
            $sessionImage->save();
        } else {
            return Response::json([
                'error' => true,
                'message' => 'Server error while uploading',
                'code' => 500
            ], 500);
        }

        $thumbnailSizes = Thumbnail::all();
        $_thumbnails = array();
        foreach ($thumbnailSizes as $thumbnailSize) {

            $_thumbnails[] = $thumbnailSize->id;
            if ($this->iconThumb($image_width, $image_height, $thumbnailSize->crop, $photo, $allowed_filename, $thumbnailSize->name, $thumbnailSize->width, $thumbnailSize->height)) {
                $sessionImage->thumbnails()->attach($thumbnailSize);
            }
        }
        $sessionImage->thumbnails()->sync($_thumbnails);

        return Response::json([
            'error' => false,
            'code' => 200,
            'filename' => $allowed_filename,
            'url' => $sessionImage->url,
            'url_thumb' => URL::to('/') . '/images/icon_size/reference_thumb/' . $allowed_filename,
            'imageId' => $sessionImage->id
        ], 200);
    }

    public function createUniqueFilename($filename, $extension)
    {
        $full_size_dir = base_path() . '/images/full_size/';
        $full_image_path = $full_size_dir . $filename . '.' . $extension;

        if (File::exists($full_image_path)) {
            // Generate token for image
            $imageToken = substr(sha1(mt_rand()), 0, 5);
            return $filename . '-' . $imageToken . '.' . $extension;
        }

        return $filename . '.' . $extension;
    }

    /**
     * Optimize Original Image
     * @param $photo
     * @param $filename
     * @return \Intervention\Image\Image
     */
    public function original($photo, $filename)
    {
        $dirPath = base_path() . '/images/full_size/';

        File::exists($dirPath) or
        File::makeDirectory($dirPath);

        $manager = new ImageManager();
        $image = $manager->make($photo)->save($dirPath . $filename);

        return $image;
    }

    /**
     * @param $image_width
     * @param $image_height
     * @param $crop
     * @param $photo
     * @param $filename
     * @param $thumbName
     * @return \Intervention\Image\Image
     */
    public function iconThumb($image_width, $image_height, $crop, $photo, $filename, $thumbName, $thumbWidth, $thumbHeight)
    {
        //print_r(func_get_args());
        $dirPath = base_path() . '/images/icon_size/' . $thumbName . '/';

        File::exists($dirPath) or
        File::makeDirectory($dirPath);

        $manager = new ImageManager();

        if ($crop) {

            $image = $manager->make($photo);

            if ($image_width > $image_height) {

                if ($thumbWidth == $thumbHeight) {
                    $image->resize(null, $thumbHeight, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    $image->crop($thumbWidth, $thumbHeight, 0, 0);

                } else if ($thumbWidth > $thumbHeight) {
                    $image->resize($thumbWidth, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    $image->crop($thumbWidth, $thumbHeight, 0, 0);
                } else {
                    $image->resize($thumbHeight, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    $image->crop($thumbWidth, $thumbHeight, 0, 0);
                }
            } else {

                if ($thumbWidth == $thumbHeight) {
                    $image->crop($image_width, $image_width, 0, 0);
                    $image->resize($thumbHeight, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                } else if ($thumbWidth > $thumbHeight) {
                    $image->resize($thumbWidth, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    $image->crop($thumbWidth, $thumbHeight, 0, (int)(($thumbWidth - $thumbHeight) / 2));
                } else {
                    $image->resize($thumbWidth, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    $image->crop($thumbWidth, $thumbHeight, 0, 0);
                }
            }

            $image->save($dirPath . $filename);

        } else {
            $image = $manager->make($photo)->resize($image_width, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($dirPath . $filename);
            return $image;
        }


        return $image;
    }

    /**
     * Create Icon From Original
     * @param $photo
     * @param $filename
     * @return \Intervention\Image\Image
     */
    public function icon($photo, $filename, $image_height, $image_width)
    {
        $dirPath = base_path() . '/images/icon_size/';

        File::exists($dirPath) or
        File::makeDirectory($dirPath);

        $left_pos = ($image_width / 2) - ($image_height / 2);

        $manager = new ImageManager();
        $image = $manager->make($photo)->crop($image_height, $image_height, (int)$left_pos, 0)
            ->resize(360, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($dirPath . $filename);

        return $image;
    }

    /**
     * Delete Image From Session folder, based on server created filename
     */
    public function delete(Image $image, Request $request)
    {
        $filename = $image->name;

        $reference = Reference::find($request->referenceId);

        $full_size_dir = base_path() . '/images/full_size/';
        $icon_size_dir = base_path() . '/images/icon_size/';


        $sessionImage = Image::where('name', 'like', $filename)->first();

        if (empty($sessionImage)) {
            return Response::json([
                'error' => true,
                'code' => 400
            ], 400);
        }

        $full_path1 = $full_size_dir . ($sessionImage->title);
        $full_path2 = $icon_size_dir . ($sessionImage->title);

        if (File::exists($full_path1)) {
            File::delete($full_path1);
        }

        if (File::exists($full_path2)) {
            File::delete($full_path2);
        }

        if (!empty($sessionImage)) {
            $sessionImage->delete();
            if ($reference != null)
                $reference->images()->detach($sessionImage->id);
        }

        $reference->images()->detach($image->id);

        return Response::json([
            'error' => false,
            'code' => 200
        ], 200);
    }

    /**
     * @param Image $image
     * @param Request $request
     * @return mixed
     */
    public function deleteProductImage(Image $image, Request $request)
    {
        $filename = $image->name;

        $product = Product::find($request->productId);

        $full_size_dir = base_path() . '/images/full_size/';
        $icon_size_dir = base_path() . '/images/icon_size/';

        $sessionImage = Image::where('name', 'like', $filename)->first();

        if (empty($sessionImage)) {
            return Response::json([
                'error' => true,
                'code' => 400
            ], 400);
        }

        $full_path1 = $full_size_dir . ($sessionImage->title);
        $full_path2 = $icon_size_dir . ($sessionImage->title);

        if (File::exists($full_path1)) {
            File::delete($full_path1);
        }

        if (File::exists($full_path2)) {
            File::delete($full_path2);
        }

        if (!empty($sessionImage)) {
            $sessionImage->delete();
            if ($product != null)
                $product->images()->detach($sessionImage->id);
        }

        $product->images()->detach($image->id);

        return Response::json([
            'error' => false,
            'code' => 200
        ], 200);
    }

    function isFileUploadRequestValid()
    {
        $post_max_size = ini_get('post_max_size') * 1024 * 1024;
        $upload_max_filesize = ini_get('upload_max_filesize') * 1024 * 1024;
        $request_content_length = isset($_SERVER['CONTENT_LENGTH']) ? (int)$_SERVER['CONTENT_LENGTH'] : 0;

        return $request_content_length < $post_max_size && $request_content_length < $upload_max_filesize;
    }

    function sanitize($string, $force_lowercase = true, $anal = false)
    {
        $strip = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "=", "+", "[", "{", "]",
            "}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;",
            "â€”", "â€“", ",", "<", ".", ">", "/", "?");
        $clean = trim(str_replace($strip, "", strip_tags($string)));
        $clean = preg_replace('/\s+/', "-", $clean);
        $clean = ($anal) ? preg_replace("/[^a-zA-Z0-9]/", "", $clean) : $clean;

        return ($force_lowercase) ?
            (function_exists('mb_strtolower')) ?
                mb_strtolower($clean, 'UTF-8') :
                strtolower($clean) :
            $clean;
    }
}