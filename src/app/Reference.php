<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Contracts\JsonInfoInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use Intervention\Image\ImageManager;

class Reference extends Model implements JsonInfoInterface
{

    const STATUS_PUBLISHED = 1;

    /**
     * Get the store that owns the profile.
     */
    public function store()
    {
        return $this->belongsTo('App\Store');
    }

    public function products()
    {
        return $this->belongsToMany('App\Product')->withTimestamps();
    }

    public function images()
    {
        return $this->belongsToMany('App\Image')->withTimestamps();
    }

    public function manufacturers()
    {
        return $this->belongsToMany('App\Manufacturer')->withTimestamps();
    }

    /**
     * @return mixed
     */
    public function mainImage()
    {
        $image = $this->images()->first();
        return $image->getImageUrl();
    }

    /**
     * @return mixed
     */
    public function mainThumbImage()
    {
        $image = $this->images()->first();
        return str_replace('full_size', 'icon_size', $image->getImageUrl());
    }

    public function getImageByThumb($slug)
    {
        $image = $this->images()->first();
        return str_replace('full_size', 'icon_size/' . $slug, $image->getImageUrl());
    }

    /**
     * @return int|string
     */
    public function getManufacturers()
    {
        if (Reference::find($this->id) != null) {
            $selected_manufacturers = Reference::find($this->id)->manufacturers()->get();
            $selected_manufacturer_ids = '';
            foreach ($selected_manufacturers as $selected_man) {
                $selected_manufacturer_ids .= ',' . $selected_man->id;
            }
            return $selected_manufacturer_ids;
        } else {
            return '';
        }
    }

    /**
     * @return false|string
     */
    public function getNiceDate()
    {
        $originalDate = $this->created_at;
        $newDate = date("d. M", strtotime($originalDate));
        return $newDate;
    }

    /**
     * @return int
     */
    public function getNumberOfImages()
    {
        return count($this->images()->get());
    }

    /**
     * @return int
     */
    public function getNumberOfProducts()
    {
        return count($this->products()->get());
    }

    /**
     * @return string
     */
    public function getManufacturersList()
    {
        if (Reference::find($this->id) != null) {

            $selected_manufacturers = Reference::find($this->id)->manufacturers()->get();
            $selected_manufacturer_names = '';
            foreach ($selected_manufacturers as $selected_man) {
                $selected_manufacturer_names .= $selected_man->name . ',';
            }
            return $selected_manufacturer_names;
        } else {
            return '';
        }
    }

    /**
     * @return string
     */
    public function getManufacturersListNice()
    {
        if (Reference::find($this->id) != null) {

            $selected_manufacturers = Reference::find($this->id)->manufacturers()->get();
            $selected_manufacturer_names = '';
            $count = 0;
            foreach ($selected_manufacturers as $selected_man) {
                $selected_manufacturer_names .= $selected_man->name;
                $suffix = ', ';
                if ($count < count($selected_manufacturer_names))
                    $selected_manufacturer_names .= $suffix;
            }
            return $selected_manufacturer_names;
        } else {
            return '';
        }
    }

    /**
     * @return mixed
     */
    public function package_name()
    {
        $store = $this->store;
        $profile = Profile::where(['store_id' => $store->id])->get()->first();

        $package = $profile->package;
        return $package->name;
    }

    /**
     *
     */
    public function incrementViews()
    {
        $current_views = $this->views;
        $current_views++;
        $this->views = $current_views;
        $this->save();
    }


    /**
     * @param Request $request
     * @param Reference $reference
     * @param $editMode
     */
    public function addImages(Request $request, Reference $reference, $editMode)
    {
        $imagesArray = $request->images;
        if (!empty($imagesArray)) {
            if ($editMode) {
                foreach ($reference->images as $existing_image) {
                    $imagesArray[] = $existing_image->id;
                }
                $reference->images()->detach();
            }

            foreach ($imagesArray as $_image) {
                $image = \App\Image::find($_image);
                $reference->images()->attach($image);
            }
            $reference->images()->sync($imagesArray);
        }
    }

    /**
     * @param Request $request
     * @param $editMode
     */
    public function addImagesRest(Request $request, $editMode)
    {
        if (isset($request->newImages)) {

            $imagesArray = $this->addImagesBase64($request->newImages, $request->title);
            if (!empty($imagesArray)) {
                if ($editMode) {
                    foreach ($this->images as $existing_image) {
                        $imagesArray[] = $existing_image->id;
                    }
                    $this->images()->detach();
                }

                foreach ($imagesArray as $_image) {
                    $image = \App\Image::find($_image);
                    $this->images()->attach($image);
                }
                $this->images()->sync($imagesArray);
            }
        }
    }

    /**
     * @param Request $request
     * @param Reference $reference
     * @param $editMode
     */
    public function addProducts(Request $request, Reference $reference, $editMode)
    {
        $_products = $request->products;

        if (is_array($_products) && !empty($_products)) {
            if ($editMode) {
                foreach ($reference->products as $existing_product) {
                    $_products[] = $existing_product->id;
                }
                $reference->products()->detach();
            }
            $reference->products()->detach();
            foreach ($_products as $_product) {
                $product = Product::find($_product);
                $reference->products()->attach($product);
            }
            $reference->products()->sync($_products);
        }
    }

    /**
     * @param Request $request
     * @param Reference $reference
     */
    public function addProductsRest(Request $request, Reference $reference)
    {
        $_products = $request->products;

        if (is_array($_products) && !empty($_products)) {
            $reference->products()->detach();
            foreach ($_products as $_product) {
                $product = Product::find($_product);
                $reference->products()->attach($product);
            }
            $reference->products()->sync($_products);
        }
    }

    /**
     * @param $manuRequest
     * @return array|bool
     */
    public function transformData($manuRequest)
    {
        if (isset($manuRequest)) {
            $_manufacturers = explode(',', $manuRequest);
            if (in_array("", $_manufacturers)) {
                array_shift($_manufacturers);
            }
            return $_manufacturers;
        } else {
            return false;
        }
    }

    /**
     * @param Request $request
     * @param Reference $reference
     */
    public function addBrands(Request $request, Reference $reference, $editMode)
    {
        if ($_manufacturers = $this->transformData($request->manufacturers)) {

            if ($editMode) {
                $reference->manufacturers()->detach();
            }
            foreach ($_manufacturers as $_manufacturer) {
                $manufacturer = Manufacturer::find($_manufacturer);
                if (is_object($manufacturer))
                    $reference->manufacturers()->attach($manufacturer);
            }
            $reference->manufacturers()->sync($_manufacturers);
        } else {
            $reference->manufacturers()->detach();
        }
    }

    /**
     * @param Request $request
     * @param Reference $reference
     */
    public function addBrandsFromArray(Request $request, Reference $reference, $editMode)
    {
        $_manufacturers = $request->manufacturers;

        if (is_array($_manufacturers) && !empty($_manufacturers)) {
            if ($editMode) {
                $reference->manufacturers()->detach();
            }
            foreach ($_manufacturers as $_manufacturer) {
                $manufacturer = Reference::find($_manufacturer);
                $reference->manufacturers()->attach($manufacturer);
            }
            $reference->manufacturers()->sync($_manufacturers);
        }
    }

    public function htmlTemplateDashboard()
    {
        $html = '<div class="col-md-6">' .
            '<div class="single-item item-shadow">' .
            '<img src="' . $this->getImageByThumb('reference_thumb') . '" alt="" class="img-responsive">' .
            '<div class="item-info">' .
            '<div class="item-info-top clearfix">' .
            '<span class="title">' . $this->title . '</span>' .
            '<span class="number-of pull-left">(' . $this->getNumberOfProducts() . ' ' . trans('messages.products') . ')</span>' .
            '<span class="date pull-right">' . $this->getNiceDate() . '</span>' .
            '</div>' .
            '<div class="item-info-bottom">' .
            '<a href="#" class="pull-left"><i class="icon-shopping-cart"></i>' . $this->store->package_name() . ': ' . $this->store->store_name . '</a>' .
            '<a href="#" class="brown-color pull-right">+ Share</a>' .
            '</div>' .
            '<div class="clearfix"></div>' .
            '<a href="' . route('dashboard_reference_edit', $this->id) . '" class="click-button">' . trans('messages.manage_reference') . '</a>' .
            '</div>' .
            '</div>' .
            '</div>';

        return $html;
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

    public function getExt($encoded_string)
    {
        $imgdata = base64_decode($encoded_string);
        $f = finfo_open();

        $mime_type = finfo_buffer($f, $imgdata, FILEINFO_MIME_TYPE);
        return $mime_type;
    }

    /**
     * @param $images64Array
     * @param $name
     * @return array
     */
    public function addImagesBase64($images64Array, $name)
    {
        $image_ids = array();

        foreach ($images64Array as $image64) {

            $allowed_filename = $this->createUniqueFilename($this->slugify($name), '.jpg');
            $imagePath = '/images/full_size/' . $allowed_filename;
            $savePath = 'images/full_size/' . $allowed_filename;
            $imageUrlFull = URL::to('/') . $imagePath;


            $sessionImage = new \App\Image;
            if ($imageNew = $this->original($image64, $allowed_filename)) {
                $sessionImage->title = $allowed_filename;
                $sessionImage->name = $allowed_filename;
                $sessionImage->url = URL::to('/') . '/images/full_size/' . $allowed_filename;
                $sessionImage->save();
            }

            $image_ids[] = $sessionImage->id;

            $image_width = $imageNew->width();
            $image_height = $imageNew->height();

            $thumbnailSizes = Thumbnail::all();
            $_thumbnails = array();
            foreach ($thumbnailSizes as $thumbnailSize) {

                $_thumbnails[] = $thumbnailSize->id;
                if ($this->iconThumb($image_width, $image_height, $thumbnailSize->crop, $image64, $allowed_filename, $thumbnailSize->name, $thumbnailSize->width, $thumbnailSize->height)) {
                    $sessionImage->thumbnails()->attach($thumbnailSize);
                }
            }
            $sessionImage->thumbnails()->sync($_thumbnails);
        }

        return $image_ids;
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

    public function iconThumb($image_width, $image_height, $crop, $photo, $filename, $thumbName, $thumbWidth, $thumbHeight)
    {
        //print_r(func_get_args());exit;
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
}
