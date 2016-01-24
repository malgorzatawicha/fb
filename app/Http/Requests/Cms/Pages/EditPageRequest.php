<?php

namespace Fb\Http\Requests\Cms\Pages;

use Fb\Http\Requests\Request;

class EditPageRequest extends Request
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
            'name' => 'alpha_num|required|max:255',
            'title' => 'required|max:255',
            'logo' => 'required|mimes:jpeg,jpg,bmp,png |max:1000',
        ];
    }
}
