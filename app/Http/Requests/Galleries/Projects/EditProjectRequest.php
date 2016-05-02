<?php

namespace Fb\Http\Requests\Galleries\Projects;

use Fb\Http\Requests\Request;

class EditProjectRequest extends Request
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
            'category' => 'required',
            'name' => 'required|max:255',
            'title' => 'required|max:255',
            'short_title' => 'max:255',
            'logo' => 'mimes:jpeg,jpg,bmp,png|max:1000',
            'active' => 'boolean',
        ];
    }
}
