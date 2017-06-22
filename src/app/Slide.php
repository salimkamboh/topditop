<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Slide
 *
 * @property int $id
 * @property string $title
 * @property string $image_url
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $slot1_store_id
 * @property string $slot1_width
 * @property string $slot1_valid_until
 * @property string $slot2_store_id
 * @property string $slot2_width
 * @property string $slot2_valid_until
 * @property string $slot3_store_id
 * @property string $slot3_width
 * @property string $slot3_valid_until
 * @property string $slot4_store_id
 * @property string $slot4_width
 * @property string $slot4_valid_until
 * @property string $slot5_store_id
 * @property string $slot5_width
 * @property string $slot5_valid_until
 * @method static \Illuminate\Database\Query\Builder|\App\Slide whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Slide whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Slide whereImageUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Slide whereSlot1StoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Slide whereSlot1ValidUntil($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Slide whereSlot1Width($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Slide whereSlot2StoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Slide whereSlot2ValidUntil($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Slide whereSlot2Width($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Slide whereSlot3StoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Slide whereSlot3ValidUntil($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Slide whereSlot3Width($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Slide whereSlot4StoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Slide whereSlot4ValidUntil($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Slide whereSlot4Width($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Slide whereSlot5StoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Slide whereSlot5ValidUntil($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Slide whereSlot5Width($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Slide whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Slide whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Slide extends Model
{
    protected $fillable = [
        'title',
        'image_url',
        'slot1_store_id',
        'slot1_width',
        'slot1_valid_until',

        'slot2_store_id',
        'slot2_width',
        'slot2_valid_until',

        'slot3_store_id',
        'slot3_width',
        'slot3_valid_until',

        'slot4_store_id',
        'slot4_width',
        'slot4_valid_until',

        'slot5_store_id',
        'slot5_width',
        'slot5_valid_until',

        'base64'
    ];

    public function getImageUrl()
    {
        return url('images' .$this->image_url);
    }


    private function cutAbsolutePath()
    {
        if (! $this->image_url) {
            return;
        }
        $messyRelativePath = parse_url($this->image_url, PHP_URL_PATH);
        $cleanRelativePath = str_replace('/topditop/images/', '/images/', $messyRelativePath);
        $cleanRelativePath = str_replace('/images/', '/', $cleanRelativePath);
        $this->image_url = $cleanRelativePath;
        $this->save();
    }

    static function replaceAllImagesPath()
    {
        $slides = Slide::all();

        foreach ($slides as $slide) {
            $slide->cutAbsolutePath();
        }
    }
}
