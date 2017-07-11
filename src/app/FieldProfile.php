<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

/**
 * App\FieldProfile
 *
 * @property int $id
 * @property int $field_id
 * @property int $profile_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\FieldProfileTranslation[] $translations
 * @method static \Illuminate\Database\Query\Builder|\App\FieldProfile listsTranslations($translationField)
 * @method static \Illuminate\Database\Query\Builder|\App\FieldProfile notTranslatedIn($locale = null)
 * @method static \Illuminate\Database\Query\Builder|\App\FieldProfile translated()
 * @method static \Illuminate\Database\Query\Builder|\App\FieldProfile translatedIn($locale = null)
 * @method static \Illuminate\Database\Query\Builder|\App\FieldProfile whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FieldProfile whereFieldId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FieldProfile whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FieldProfile whereProfileId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FieldProfile whereTranslation($key, $value, $locale = null)
 * @method static \Illuminate\Database\Query\Builder|\App\FieldProfile whereTranslationLike($key, $value, $locale = null)
 * @method static \Illuminate\Database\Query\Builder|\App\FieldProfile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FieldProfile withTranslation()
 * @mixin \Eloquent
 */
class FieldProfile extends Model
{

    use \Dimsav\Translatable\Translatable;

    public $translatedAttributes = ['selected'];

    protected $fillable = ['selected'];

    protected $table = 'field_profile';

}
