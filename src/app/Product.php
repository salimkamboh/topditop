<?php

namespace App;

use App\Helpers\Contracts\JsonInfoInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;

class Product extends Model implements JsonInfoInterface
{
    /**
     * Get the Store that owns the Product.
     */
    public function store()
    {
        return $this->belongsTo('App\Store');
    }

    public function references()
    {
        return $this->belongsToMany('App\Reference')->withTimestamps();
    }

    public function images()
    {
        return $this->belongsToMany('App\Image')->withTimestamps();
    }

    public function categories()
    {
        return $this->belongsToMany('App\Category')->withTimestamps();
    }

    /**
     * Get the Manufacturer that owns the Product.
     */
    public function manufacturer()
    {
        return $this->belongsTo('App\Manufacturer');
    }

    public function mainThumbImage()
    {
        $image = $this->images()->first();
        if (! $image) {
            return 'http://placehold.it/600x600';
        }
        return str_replace('full_size', 'icon_size', $image->getImageUrl());
    }

    public function getImageByThumb($slug)
    {
        $image = $this->images()->first();
        if (! $image) {
            return 'http://placehold.it/450x450';
        }
        return str_replace('full_size', 'icon_size/' . $slug, $image->getImageUrl());
    }

    public function mainImage()
    {
        $image = $this->images()->first();
        if (! $image) {
            return 'http://placehold.it/500x500';
        }
        return $image->getImageUrl();
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

    public function getManufacturer()
    {
        if (Product::find($this->id) != null) {
            $selected_manufacturer = Product::find($this->id)->manufacturer()->get()->first();
            if ($selected_manufacturer != null) {
                return $selected_manufacturer->id;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    public function getManufacturerName()
    {
        if (Product::find($this->id) != null) {
            $selected_manufacturer = Product::find($this->id)->manufacturer()->get()->first();
            if ($selected_manufacturer != null) {
                return $selected_manufacturer->name;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    public function getNumberOfReferences()
    {
        return count($this->references()->get());
    }

    public function getNiceDate()
    {
        $originalDate = $this->created_at;
        $newDate = date("d. M", strtotime($originalDate));
        return $newDate;
    }

    public function getCategories()
    {
        if (Product::find($this->id) != null) {
            $selected_categories = Product::find($this->id)->categories()->get();
            $selected_categories_ids = '';
            foreach ($selected_categories as $selected_cat) {
                $selected_categories_ids .= ',' . $selected_cat->id;
            }
            return $selected_categories_ids;
        } else {
            return '';
        }
    }

    public function getCategoriesNice()
    {
        if (Product::find($this->id) != null) {
            $selected_categories = Product::find($this->id)->categories()->get();
            $selected_categories_ids = '';
            $count = 0;
            foreach ($selected_categories as $selected_cat) {
                $selected_categories_ids .= $selected_cat->name;
                $suffix = ', ';
                if ($count < count($selected_categories) - 1)
                    $selected_categories_ids .= $suffix;

                $count++;
            }
            return $selected_categories_ids;
        } else {
            return '';
        }
    }

    /**
     *
     */
    public function incrementViews()
    {
        $user = Auth::user();
        if (is_object($user) && $user->id !== $this->store->user->id) {
            $current_views = $this->views;
            $current_views++;
            $this->views = $current_views;
            $this->save();
        }
    }

    /**
     * @param Request $request
     * @param Product $product
     * @param $editMode
     */
    public function addImages(Request $request, Product $product, $editMode)
    {
        $imagesArray = $request->images;
        if (!empty($imagesArray)) {
            if ($editMode) {
                foreach ($product->images as $existing_image) {
                    $imagesArray[] = $existing_image->id;
                }
                $product->images()->detach();
            }

            foreach ($imagesArray as $_image) {
                $image = Image::find($_image);
                $product->images()->attach($image);
            }
            $product->images()->sync($imagesArray);
        }
    }

    /**
     * @param Request $request
     * @param Product $product
     * @param $editMode
     */
    public function addReferences(Request $request, Product $product, $editMode)
    {
        $_references = $request->references;
        if (is_array($_references) && !empty($_references)) {
            if ($editMode) {
                foreach ($product->references as $existing_reference) {
                    $_references[] = $existing_reference->id;
                }
            }
            $product->references()->detach();
            foreach ($_references as $_reference) {
                $reference = Reference::find($_reference);
                $product->references()->attach($reference);
            }
            $product->references()->sync($_references);
        }
    }

    /**
     * @param Request $request
     * @param $editMode
     */
    public function addReferencesRest(Request $request, $editMode)
    {
        $_references = $request->references;
        if (is_array($_references) && !empty($_references)) {
            $this->references()->detach();
            foreach ($_references as $_reference) {
                $reference = Reference::find($_reference);
                $this->references()->attach($reference);
            }
            $this->references()->sync($_references);
        }
    }

    /**
     * @param Request $request
     * @param Product $product
     * @param $editMode
     */
    public function addBrand(Request $request, Product $product, $editMode)
    {
        if (!empty($request->manufacturer)) {
            $manufacturerObject = Manufacturer::find($request->manufacturer);
            $product->manufacturer()->associate($manufacturerObject);
        } else {
            $manufacturerObject = null;
        }
    }

    /**
     * @param Request $request
     * @param Product $product
     * @param $editMode
     */
    public function addBrandRest(Request $request, Product $product, $editMode)
    {
        if (!empty($request->manufacturer_id)) {
            $manufacturerObject = Manufacturer::find($request->manufacturer_id);
            $product->manufacturer()->associate($manufacturerObject);
        } else {
            $manufacturerObject = null;
        }
    }

    /**
     * @param Request $request
     * @param Product $product
     * @param $editMode
     */
    public function addCategories(Request $request, Product $product, $editMode)
    {

        if ($_categories = $this->transformData($request->categories)) {

            if ($editMode) {
                $product->categories()->detach();
            }
            foreach ($_categories as $_category) {
                $category = Category::find($_category);
                if (is_object($category))
                    $product->categories()->attach($category);
            }
            $product->categories()->sync($_categories);
        } else {
            $product->categories()->detach();
        }
    }

    /**
     * @param $catRequest
     * @return array|bool
     */
    public function transformData($catRequest)
    {
        if (isset($catRequest)) {
            $_categories = explode(',', $catRequest);
            if (in_array("", $_categories)) {
                array_shift($_categories);
            }
            return $_categories;
        } else {
            return false;
        }
    }

    /**
     * @param Request $request
     * @param $editMode
     */
    public function addCategoriesRest(Request $request, $editMode)
    {
        $_categories = $request->categories;

        if (is_array($_categories) && !empty($_categories)) {
            if ($editMode) {
                $this->categories()->detach();
            }
            foreach ($_categories as $_category) {
                $category = Category::find($_category);
                $this->categories()->attach($category);
            }
            $this->categories()->sync($_categories);
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
            '<span class="number-of pull-left">(' . $this->getNumberOfReferences() . ' ' . trans('messages.references') . ')</span>' .
            '<span class="price"><i class="icon-eur"></i>' . $this->price . '</span>' .
            '</div>' .
            '<div class="item-info-bottom">' .
            '<a href="#" class="pull-left separator-bottom"><i class="icon-tags"></i>' . $this->manufacturer->name . '</a>' .
            '<div class="clearfix"></div>' .
            '</div>' .
            '<a href="' . route('dashboard_product_edit', $this->id) . '" class="click-button">' . trans('messages.manage_product') . '</a>' .
            '<a href="#" data-prodId="' . $this->id . '" class="disconnect-product click-button">' . trans('messages.delete_product') . '</a>' .
            '</div>' .
            '</div>' .
            '</div>';
        return $html;
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
     * @param $images64Array
     * @param $name
     * @return array
     */
    public function addImagesBase64($images64Array, $name)
    {
        $image_ids = array();

        foreach ($images64Array as $image64) {

            $randomString = str_random(6);
            $sluggedName = str_slug($name);

            $generatedName = "product_{$randomString}_{$sluggedName}.jpg";

            $sessionImage = new \App\Image;

            if ($imageNew = $this->original($image64, $generatedName)) {
                $sessionImage->title = $generatedName;
                $sessionImage->name = $generatedName;
                $sessionImage->url = '/full_size/' . $generatedName;
                $sessionImage->save();
            }

            $image_ids[] = $sessionImage->id;

            $image_width = $imageNew->width();
            $image_height = $imageNew->height();

            $thumbnailSizes = Thumbnail::all();
            $_thumbnails = array();
            foreach ($thumbnailSizes as $thumbnailSize) {

                $_thumbnails[] = $thumbnailSize->id;
                if ($this->iconThumb($image_width, $image_height, $thumbnailSize->crop, $image64, $generatedName, $thumbnailSize->name, $thumbnailSize->width, $thumbnailSize->height)) {
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

    /**
     * @return string
     */
    public function getProdRefImages()
    {
        $result = [];
        $refs = $this->references()->get();

        foreach($refs as $ref) {
            if (is_object($ref)) {
                $result[] = $ref->getImageByThumb('reference_thumb');
            }
        }

        return $result;
    }

    /**
     * @return string
     */
    public function getProdRefId()
    {
        $ref = $this->references()->get()->first();
        if (is_object($ref))
            return $ref->id;
        else
            return '';
    }
}
