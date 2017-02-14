<?php

namespace App\Http\Requests\Adverts;

use App\Http\Requests\Request;

class CreateAdvertRequest extends Request
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
            'name' => 'min:2|max:60',
            'manufacturer_id' => 'required|exists:manufacturers,id',
        ];
    }
}
