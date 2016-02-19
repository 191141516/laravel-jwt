<?php

namespace App\Api\Requests;

use App\Http\Requests\Request;

class DogRequest extends Request
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
	        'name' => 'required|max:100',
	        'age' => 'required|numeric|between:0,40'
        ];
    }
}
