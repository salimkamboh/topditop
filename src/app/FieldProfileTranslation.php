<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\FieldProfileTranslation
 *
 * @property int $id
 * @property int $field_profile_id
 * @property string $locale
 * @property string $selected
 * @method static \Illuminate\Database\Query\Builder|\App\FieldProfileTranslation whereFieldProfileId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FieldProfileTranslation whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FieldProfileTranslation whereLocale($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FieldProfileTranslation whereSelected($value)
 * @mixin \Eloquent
 */
class FieldProfileTranslation extends Model
{
    public $timestamps = false;
}