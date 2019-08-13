<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;

/**
 * App\BrandReference
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $image_url
 * @property int $manufacturer_id
 * @property int $category_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $thumbnail_small_url
 * @property string $thumbnail_medium_url
 * @property string $thumbnail_large_url
 * @property-read \App\Category $category
 * @property-read \App\Manufacturer $manufacturer
 * @method static \Illuminate\Database\Query\Builder|\App\BrandReference whereCategoryId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\BrandReference whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\BrandReference whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\BrandReference whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\BrandReference whereImageUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\BrandReference whereManufacturerId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\BrandReference whereThumbnailLargeUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\BrandReference whereThumbnailMediumUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\BrandReference whereThumbnailSmallUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\BrandReference whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\BrandReference whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class BrandReference extends Model
{
    //

    protected $table = 'brandreferences';

    protected $thumbnailWidthSmall = 320;
    protected $thumbnailWidthMedium = 480;
    protected $thumbnailWidthLarge = 640;

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function hasCategory()
    {
        if ($this->category instanceof Category) {
            return true;
        }
        return false;
    }

    public function getImageUrl()
    {
        return url('images' . $this->image_url);
    }

    public function getThumbnailSmallUrl()
    {
        return url('images' . $this->thumbnail_small_url);
    }

    public function getThumbnailMediumUrl()
    {
        return url('images' . $this->thumbnail_medium_url);
    }

    public function getThumbnailLargeUrl()
    {
        return url('images' . $this->thumbnail_large_url);
    }

    public function saveOriginal($binary)
    {
        $relative = "/full_size/brandreferences/{$this->id}/original.png";
        Storage::disk('images')->put($relative, $binary);
        $this->image_url = $relative;
    }

    public function generateThumbnails()
    {
        $relativeOriginal = "/full_size/brandreferences/{$this->id}/original.png";
        $absolute = base_path("images{$relativeOriginal}");
        $binary = file_get_contents($absolute);
        if (! $binary) {
            throw new \Exception("Original image not found");
        }
        $manager = new ImageManager();

        $small = "/full_size/brandreferences/{$this->id}/{$this->thumbnailWidthSmall}xAUTO.png";
        $manager->make($binary)->resize($this->thumbnailWidthSmall, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save(base_path("images{$small}"));
        $this->thumbnail_small_url = $small;

        $medium = "/full_size/brandreferences/{$this->id}/{$this->thumbnailWidthMedium}xAUTO.png";
        $manager->make($binary)->resize($this->thumbnailWidthMedium, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save(base_path("images{$medium}"));
        $this->thumbnail_medium_url = $medium;

        $large = "/full_size/brandreferences/{$this->id}/{$this->thumbnailWidthLarge}xAUTO.png";
        $manager->make($binary)->resize($this->thumbnailWidthLarge, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save(base_path("images{$large}"));
        $this->thumbnail_large_url = $large;
    }
}
