<?php

namespace App\Http\Requests\Adverts\Images;

use App\Http\Requests\Request;

class SetAdvertImageRequest extends Request
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
            'base64' => 'required',
            'type' => 'required|in:reference_image,brand_logo,scanned_image'
        ];
    }
}
