<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\FieldTranslation
 *
 * @property int $id
 * @property int $field_id
 * @property string $locale
 * @property string $name
 * @property string $values
 * @method static \Illuminate\Database\Query\Builder|\App\FieldTranslation whereFieldId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FieldTranslation whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FieldTranslation whereLocale($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FieldTranslation whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FieldTranslation whereValues($value)
 * @mixin \Eloquent
 */
class FieldTranslation extends Model
{
    public $timestamps = false;

}
