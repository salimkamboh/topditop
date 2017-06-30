<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Field
 *
 * @property int $id
 * @property string $key
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $fieldtype_id
 * @property int $field_group_id
 * @property string $cssclass
 * @property bool $active
 * @property int $order
 * @property-read \App\FieldGroup $fieldGroup
 * @property-read \App\Fieldtype $fieldtype
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Profile[] $profiles
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\FieldTranslation[] $translations
 * @method static \Illuminate\Database\Query\Builder|\App\Field listsTranslations($translationField)
 * @method static \Illuminate\Database\Query\Builder|\App\Field notTranslatedIn($locale = null)
 * @method static \Illuminate\Database\Query\Builder|\App\Field translated()
 * @method static \Illuminate\Database\Query\Builder|\App\Field translatedIn($locale = null)
 * @method static \Illuminate\Database\Query\Builder|\App\Field whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Field whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Field whereCssclass($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Field whereFieldGroupId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Field whereFieldtypeId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Field whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Field whereKey($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Field whereOrder($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Field whereTranslation($key, $value, $locale = null)
 * @method static \Illuminate\Database\Query\Builder|\App\Field whereTranslationLike($key, $value, $locale = null)
 * @method static \Illuminate\Database\Query\Builder|\App\Field whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Field withTranslation()
 * @mixin \Eloquent
 */
class Field extends Model
{

    use \Dimsav\Translatable\Translatable;

    public $translatedAttributes = ['name', 'values'];

    protected $fillable = ['name', 'key', 'values', 'cssclass'];

    private $htmlConvertContract;

    public function __construct()
    {
        parent::__construct();
        $this->htmlConvertContract = \App::make('App\Helpers\Contracts\HtmlConvertContract');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fieldGroup()
    {
        return $this->belongsTo('App\FieldGroup');
    }

    /**
     * Get the fieldtype that owns the user
     */
    public function fieldtype()
    {
        return $this->belongsTo('App\Fieldtype');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function profiles()
    {
        return $this->belongsToMany('App\Profile')->withTimestamps();;

    }

    /**
     * @param $profile
     * @return mixed
     */
    public function htmlHelper($profile)
    {
        return $this->htmlConvertContract->htmlHelper($this, $profile);
    }

    /**
     * @param $fieldKey
     * @param $store
     * @return string
     */
    public static function getSelectedValues($fieldKey, $store)
    {
        $fieldObject = Field::where(['key' => $fieldKey])->get()->first();

        if (is_object($fieldObject)) {
            $profile = $store->profile;

            $selectedValues = "";
            foreach ($profile->fields as $field) {
                if ($field->id == $fieldObject->id) {
                    /** @var FieldProfile $fieldProfilePIVOT */
                    $fieldProfilePIVOT = FieldProfile::where(['field_id' => $field->id, 'profile_id' => $profile->id])->get()->first();
                    if (is_object($fieldProfilePIVOT->translate()))
                        $selectedValues = $fieldProfilePIVOT->translate()->selected;
                    else
                        $selectedValues = "";
                }
            }
        } else {
            $selectedValues = "";
        }

        return $selectedValues;
    }

    public static function getAllValues($fieldKey)
    {
        $fieldObject = Field::where(['key' => $fieldKey])->get()->first();
        $fieldObjects = array_filter(explode(",", $fieldObject->values));
        return $fieldObjects;
    }
}
