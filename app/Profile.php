<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

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

    /**
     * @return int
     */
    public function getPackageLimit()
    {
        $packageName = $this->store->package_name();
        if ($packageName == "TopDiTop Store") {
            $limit = 25;
        } else if ($packageName == "TopStore") {
            $limit = 10;
        } else {
            $limit = 5;
        }
        return $limit;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveProfile(Request $request)
    {

        $locale = App::getLocale();
        $statusError = null;
        $id_array = array();
        $requestData = $request->all();

        if ($this->getPackageLimit() < $this->numOfBrandsInRequest($request)) {
            $statusError = 'Your store can have a maximum of ' . $this->getPackageLimit() . ' brands';
            return redirect()->action('StoreController@settings')
                ->with('fail', $statusError);
        }


        foreach ($requestData as $item => $value) {

            $field = Field::where('key', $item)->get()->first();
            if (is_object($field)) {
                $id_array[] = $field->id;
                if (is_array($value)) {
                    $fieldProfilePIVOT = FieldProfile::where(['field_id' => $field->id, 'profile_id' => $this->id])->get()->first();
                    if ($fieldProfilePIVOT != null) {
                        $fieldProfilePIVOT->translateOrNew($locale)->selected = $this->htmlConvertContract->arrayToString($value);
                        $fieldProfilePIVOT->save();
                    } else {

                        $fieldProfilePIVOT = new FieldProfile();
                        $fieldProfilePIVOT->field_id = $field->id;
                        $fieldProfilePIVOT->profile_id = $this->id;

                        /** @var FieldProfile $fieldProfilePIVOT */
                        $fieldProfilePIVOT->translateOrNew($locale)->selected = $this->htmlConvertContract->arrayToString($value);
                        $fieldProfilePIVOT->save();
                    }
                } else {
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
        }

        if (!$this->handleStoreNameChange($request, $this)) {
            $statusError = 'Duplicate store name';
        }

        return redirect()->action('StoreController@settings')
            ->with('success', 'Profile updated!')
            ->with('fail', $statusError);
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
}
