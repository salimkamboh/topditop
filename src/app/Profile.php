<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

/**
 * App\Profile
 *
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $store_id
 * @property int $image_id
 * @property int $package_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Field[] $fields
 * @property-read \App\Image $image
 * @property-read \App\Package $package
 * @property-read \App\Store $store
 * @method static \Illuminate\Database\Query\Builder|\App\Profile whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Profile whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Profile whereImageId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Profile wherePackageId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Profile whereStoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Profile whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Profile extends Model
{
    private $htmlConvertContract;

    public function __construct()
    {
        parent::__construct();
        $this->htmlConvertContract = \App::make('App\Helpers\Contracts\HtmlConvertContract');
    }

    /**
     * Get the store that owns the profile.
     */
    public function store()
    {
        return $this->belongsTo('App\Store');
    }

    /**
     * Get the image that owns the profile.
     */
    public function image()
    {
        return $this->belongsTo('App\Image');
    }
    
    public function categories()
    {
        return $this->store()->categories();// or Profile::class
    }

    /**
     * Get the store that owns the profile.
     */
    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function fields()
    {
        return $this->belongsToMany('App\Field')->withTimestamps();;
    }

    /**
     * @param Request $request
     * @return int
     */
    public function numOfBrandsInRequest(Request $request)
    {
        if (isset($request->brands)) {
            return count($request->brands);
        } else {
            return 0;
        }
    }

    public function hasValueForField(string $name)
    {
        $field = Field::where('key', $name)->first();

        if (! $field instanceof Field) {
            return false;
        }

        $fieldProfilePIVOT = FieldProfile::where(['field_id' => $field->id, 'profile_id' => $this->id])->first();

        if (!$fieldProfilePIVOT instanceof FieldProfile) {
            return false;
        }

        if (strlen($fieldProfilePIVOT->translate()->selected) < 1) {
            return false;
        }

        return true;
    }

    public function setField(string $name, string $value)
    {
        $field = Field::where('key', $name)->first();

        if (! $field instanceof Field) {
            return;
        }

        $fieldProfilePIVOT = FieldProfile::where(['field_id' => $field->id, 'profile_id' => $this->id])->first();

        $locale = App::getLocale();

        if ($fieldProfilePIVOT instanceof FieldProfile) {
            //already has that field in the profile, update
            $fieldProfilePIVOT->translateOrNew($locale)->selected = $value;
            $fieldProfilePIVOT->save();
        } else {
            //doesnt have that particular field yet, create it
            $fieldProfilePIVOT = new FieldProfile();
            $fieldProfilePIVOT->field_id = $field->id;
            $fieldProfilePIVOT->profile_id = $this->id;
            $fieldProfilePIVOT->translateOrNew($locale)->selected = $value;
            $fieldProfilePIVOT->save();
        }
    }

    /**
     * @return int
     */
    public function getPackageLimit()
    {
        $packageName = $this->store->package_name();

        $defaultLimit = 5;

        switch ($packageName) {
            case Package::HIGHEST:
                return 25;
            case Package::MIDDLE:
                return 10;
            case Package::LOWEST:
                return 5;
            case Package::LIGHT:
                return 5;
            default:
                return $defaultLimit;
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveProfile(Request $request, Profile $profile)
    {
        $this->touch();
        $locale = App::getLocale();
        $statusError = null;
        $id_array = array();
        $requestData = $request->all();

        foreach ($requestData as $item => $value) {
            $field = Field::where('key', $item)->get()->first();

            if ($item == 'categories') {
                $this->addCategories($request,$profile, true);
                continue;
            }
            
            if (! $field instanceof Field) {
                continue;
            }
            
            if ($item == 'brands') {
                $this->updateManufacturers($field, $value, $locale);
                continue;
            }

            $id_array[] = $field->id;

            if (is_array($value)) {
                $fieldProfilePIVOT = $this->handleArrayValueField($field, $value, $locale);
                continue;
            }

            $this->handleNonArrayValueField($field, $value, $locale);
        }

        if ($request->has('store_latitude') && $request->has('store_longitude')) {
            $latitude = (double) $request->store_latitude;
            $longitude = (double) $request->store_longitude;

            if ($latitude && $longitude) {
                $store = $this->store;
                $store->latitude = $latitude;
                $store->longitude = $longitude;
                $store->uses_coordinates = true;
                $store->save();
            }
        }

        if (!$this->handleStoreNameChange($request, $this)) {
            $statusError = 'Duplicate store name';
        }

        return redirect()->action('StoreController@settings')
            ->with('success', trans('messages.profil_updated'))
            ->with('fail', $statusError);
    }
    
    /**
     * @param Request $request
     * @param Product $product
     * @param $editMode
     */
    public function addCategories(Request $request, Profile $profile, $editMode)
    {
        $store = $profile->store;

        if ($_categories = $this->transformData($request->categories)) {

            if ($editMode) {
                $store->categories()->detach();
            }
            foreach ($_categories as $_category) {
                $category = Category::find($_category);
                if (is_object($category))
                    $store->categories()->attach($category);
            }
            $store->categories()->sync($_categories);
        } else {
            $store->categories()->detach();
        }
    }
    
    /**
     * @param Request $request
     * @param $editMode
     */
    public function addCategoriesRest(Request $request, $editMode)
    {
        $_categories = $request->categories;

        if (is_array($_categories) && !empty($_categories)) {
            if ($editMode) {
                $this->categories()->detach();
            }
            foreach ($_categories as $_category) {
                $category = Category::find($_category);
                $this->categories()->attach($category);
            }
            $this->categories()->sync($_categories);
        }
    }
    
    /**
     * @param $catRequest
     * @return array|bool
     */
    public function transformData($catRequest)
    {
        if (isset($catRequest)) {
            $_categories = explode(',', $catRequest);
            if (in_array("", $_categories)) {
                array_shift($_categories);
            }
            return $_categories;
        } else {
            return false;
        }
    }


    /**
     * @param Request $request
     * @param Profile $profile
     * @return bool
     */
    public function handleStoreNameChange(Request $request, Profile $profile)
    {
        if (!empty($request->storename)) {

            $store = $profile->store;
            $store->store_name = $request->storename;

            try {
                $store->save();
                return true;
            } catch (\Exception $exception) {
                return false;
            }
        } else {
            return true;
        }
    }

    public function updateManufacturers(Field $field, $manufacturersArray, $locale)
    {
        $store = $this->store;
        $store->manufacturers()->sync($manufacturersArray);
        if (is_array($manufacturersArray)) {
            $this->handleArrayValueField($field, $manufacturersArray, $locale);
        }
    }

    /**
     * @param $field_key
     * @return string
     */
    public function getApi1($field_key)
    {

        $field = Field::where('key', $field_key)->get()->first();
        if (is_object($field)) {
            $fieldProfilePIVOT = FieldProfile::where(['field_id' => $field->id, 'profile_id' => $this->id])->get()->first();
            if (is_object($fieldProfilePIVOT)) {
                return $fieldProfilePIVOT->selected;
            } else {
                return '';
            }
        } else {
            return '';
        }

    }

    /**
     * @param $field
     * @param $value
     * @param $locale
     * @return FieldProfile
     */
    private function handleArrayValueField($field, $value, $locale)
    {
        $fieldProfilePIVOT = FieldProfile::where(['field_id' => $field->id, 'profile_id' => $this->id])->get()->first();
        if ($fieldProfilePIVOT != null) {
            $fieldProfilePIVOT->translateOrNew($locale)->selected = $this->htmlConvertContract->arrayToString($value);
            $fieldProfilePIVOT->save();
            return $fieldProfilePIVOT;
        } else {

            $fieldProfilePIVOT = new FieldProfile();
            $fieldProfilePIVOT->field_id = $field->id;
            $fieldProfilePIVOT->profile_id = $this->id;

            /** @var FieldProfile $fieldProfilePIVOT */
            $fieldProfilePIVOT->translateOrNew($locale)->selected = $this->htmlConvertContract->arrayToString($value);
            $fieldProfilePIVOT->save();
            return $fieldProfilePIVOT;
        }
    }

    /**
     * @param $field
     * @param $value
     * @param $locale
     */
    private function handleNonArrayValueField(Field $field, $value, $locale)
    {
        $fieldProfilePIVOT = FieldProfile::where(['field_id' => $field->id, 'profile_id' => $this->id])->get()->first();
        if ($fieldProfilePIVOT != null) {
            $fieldProfilePIVOT->translateOrNew($locale)->selected = $value;
            $fieldProfilePIVOT->save();
        } else {

            $fieldProfilePIVOT = new FieldProfile();
            $fieldProfilePIVOT->field_id = $field->id;
            $fieldProfilePIVOT->profile_id = $this->id;

            /** @var FieldProfile $fieldProfilePIVOT */
            $fieldProfilePIVOT->translateOrNew($locale)->selected = $value;
            $fieldProfilePIVOT->save();
        }
    }
}
