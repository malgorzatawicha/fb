<?php

namespace Fb\Http\Requests\Site;

use Fb\Http\Requests\Request;

class EditSiteRequest extends Request
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
            'title' => 'required | max:255',
            'favicon' => 'mimes:ico|max:1000',
            'banner' => 'mimes:jpeg,jpg,bmp,png| max:1000',
        ];
    }
}
