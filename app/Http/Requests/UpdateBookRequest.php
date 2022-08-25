<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBookRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required','regex:/^[\pL\s\d\-]+$/u','min:3',Rule::unique('books','name')->ignore($this->book)],
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
