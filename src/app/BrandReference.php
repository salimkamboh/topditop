<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
 * @property-read \App\Category $category
 * @property-read \App\Manufacturer $manufacturer
 * @method static \Illuminate\Database\Query\Builder|\App\BrandReference whereCategoryId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\BrandReference whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\BrandReference whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\BrandReference whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\BrandReference whereImageUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\BrandReference whereManufacturerId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\BrandReference whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\BrandReference whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class BrandReference extends Model
{
    //

    protected $table = 'brandreferences';

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }

    public function category()
    {
        return $this->hasOne(Category::class);
    }
}
