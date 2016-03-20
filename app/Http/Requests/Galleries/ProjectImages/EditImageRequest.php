<?php

namespace Fb\Http\Requests\Galleries\ProjectImages;

use Fb\Http\Requests\Request;

class EditImageRequest extends Request
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
            'name' => 'required',
            'active' => 'boolean',
            'base_image' => 'required|mimes:jpeg,jpg,bmp,png|max:1000',
            'big_image' => 'required|mimes:jpeg,jpg,bmp,png|max:1000',
            'thumb_image' => 'required|mimes:jpeg,jpg,bmp,png|max:1000',
        ];
    }
}