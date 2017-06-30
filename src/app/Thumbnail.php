<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Thumbnail
 *
 * @property int $id
 * @property string $name
 * @property int $width
 * @property int $height
 * @property bool $crop
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Image[] $images
 * @method static \Illuminate\Database\Query\Builder|\App\Thumbnail whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Thumbnail whereCrop($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Thumbnail whereHeight($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Thumbnail whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Thumbnail whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Thumbnail whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Thumbnail whereWidth($value)
 * @mixin \Eloquent
 */
class Thumbnail extends Model
{
    protected $fillable = ['name', 'width', 'height', 'crop'];

    public function images()
    {
        return $this->belongsToMany('App\Image')->withTimestamps();
    }
}
