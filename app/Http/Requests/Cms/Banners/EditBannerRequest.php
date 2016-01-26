<?php

namespace Fb\Http\Requests\Cms\Banners;

use Fb\Http\Requests\Request;

class EditBannerRequest extends Request
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
            'image' => 'required|mimes:jpeg,jpg,bmp,png|max:1000'
        ];
    }
}
