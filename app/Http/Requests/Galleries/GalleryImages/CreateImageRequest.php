<?php

namespace Fb\Http\Requests\Gallery\GalleryImages;

use Fb\Http\Requests\Request;

class CreateImageRequest extends Request
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
            'image_name' => 'alpha_num | required | unique:product_images',
            'mobile_name' => 'alpha_num | required | unique:product_images',
            'is_active' => 'boolean',
            'image' => 'required | mimes:jpeg,jpg,bmp,png | max:1000',
            'mobile' => 'required | mimes:jpeg,jpg,bmp,png | max:1000',
        ];
    }
}
