<?php

namespace App\Http\Requests\Stores;

use App\Http\Requests\Request;

class FullStoreSetupRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email|unique:users',
            'company' => 'required|unique:stores,store_name',
            'package_id' => 'required|exists:packages,id',
            'location_id' => 'required|exists:locations,id',
        ];
    }
}
