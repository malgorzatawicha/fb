<?php

namespace Fb\Http\Requests\Galleries\Gallery;

use Fb\Http\Requests\Request;

class CreateGalleryRequest extends Request
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
            'name' => 'alpha_num | required | max:255',
        ];
    }
}
