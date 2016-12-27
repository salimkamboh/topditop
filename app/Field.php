<?php

namespace App;

use App\Helpers\Contracts\HtmlConvertContract;
use Illuminate\Database\Eloquent\Model;

use DB;

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
