<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Panel
 *
 * @property int $id
 * @property int $package_id
 * @property string $description
 * @property string $key
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\FieldGroup[] $fieldGroups
 * @property-read \App\Package $package
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\PanelTranslation[] $translations
 * @method static \Illuminate\Database\Query\Builder|\App\Panel listsTranslations($translationField)
 * @method static \Illuminate\Database\Query\Builder|\App\Panel notTranslatedIn($locale = null)
 * @method static \Illuminate\Database\Query\Builder|\App\Panel translated()
 * @method static \Illuminate\Database\Query\Builder|\App\Panel translatedIn($locale = null)
 * @method static \Illuminate\Database\Query\Builder|\App\Panel whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Panel whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Panel whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Panel whereKey($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Panel wherePackageId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Panel whereTranslation($key, $value, $locale = null)
 * @method static \Illuminate\Database\Query\Builder|\App\Panel whereTranslationLike($key, $value, $locale = null)
 * @method static \Illuminate\Database\Query\Builder|\App\Panel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Panel withTranslation()
 * @mixin \Eloquent
 */
class Panel extends Model
{

    use \Dimsav\Translatable\Translatable;

    protected $fillable = ['key', 'name'];

    public $translatedAttributes = ['name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function fieldGroups()
    {
        return $this->belongsToMany('App\FieldGroup');
    }

    public function orderedFieldGroups()
    {
        return $this->fieldGroups()->orderBy("tableorder");
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function package()
    {
        return $this->belongsTo('App\Package');
    }

    /**
     * @return array
     */
    public function getAssociatedFieldGroupIds()
    {
        $ids = array();
        foreach ($this->fieldGroups as $item) {
            $ids[] = $item->id;
        }
        return $ids;
    }
}