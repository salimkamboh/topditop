<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\FieldGroup
 *
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $cssclass
 * @property bool $active
 * @property int $tableorder
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Field[] $fields
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Package[] $packages
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Panel[] $panels
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\FieldGroupTranslation[] $translations
 * @method static \Illuminate\Database\Query\Builder|\App\FieldGroup listsTranslations($translationField)
 * @method static \Illuminate\Database\Query\Builder|\App\FieldGroup notTranslatedIn($locale = null)
 * @method static \Illuminate\Database\Query\Builder|\App\FieldGroup translated()
 * @method static \Illuminate\Database\Query\Builder|\App\FieldGroup translatedIn($locale = null)
 * @method static \Illuminate\Database\Query\Builder|\App\FieldGroup whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FieldGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FieldGroup whereCssclass($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FieldGroup whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FieldGroup whereTableorder($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FieldGroup whereTranslation($key, $value, $locale = null)
 * @method static \Illuminate\Database\Query\Builder|\App\FieldGroup whereTranslationLike($key, $value, $locale = null)
 * @method static \Illuminate\Database\Query\Builder|\App\FieldGroup whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FieldGroup withTranslation()
 * @mixin \Eloquent
 */
class FieldGroup extends Model
{
    use \Dimsav\Translatable\Translatable;

    public $translatedAttributes = ['name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function packages() {
        return $this->belongsToMany('App\Package');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fields() {
        return $this->hasMany('App\Field', 'field_group_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function panels()
    {
        return $this->belongsToMany('App\Panel');
    }
}