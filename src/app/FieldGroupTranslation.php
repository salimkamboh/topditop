<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\FieldGroupTranslation
 *
 * @property int $id
 * @property int $field_group_id
 * @property string $locale
 * @property string $name
 * @method static \Illuminate\Database\Query\Builder|\App\FieldGroupTranslation whereFieldGroupId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FieldGroupTranslation whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FieldGroupTranslation whereLocale($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FieldGroupTranslation whereName($value)
 * @mixin \Eloquent
 */
class FieldGroupTranslation extends Model
{
    public $timestamps = false;

}
