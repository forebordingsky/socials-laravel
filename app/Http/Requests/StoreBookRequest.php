<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|regex:/^[\pL\s\d\-]+$/u|unique:books|min:3',
            'content' => 'required|regex:/^[\pL\s\d\-]+$/u|min:3'
        ];
    }

    public function messages()
    {
        return [
            'name.regex' => 'Can contain only alpha numeric and whitespaces.',
            'content.regex' => 'Can contain only alpha numeric and whitespaces.',
        ];
    }
}
