<?php

namespace Fb\Http\Requests\Gallery\GalleryImages;

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
            'is_active' => 'boolean',
            'image' => 'mimes:jpeg,jpg,bmp,png | max:1000',
            'mobile_image' => 'mimes:jpeg,jpg,bmp,png | max:1000',
        ];
    }
}
