<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'header' => 'required|regex:/^[\pL\s\d\-]+$/u|min:3',
            'description' => 'required|regex:/^[\pL\s\d\-]+$/u|min:3',
            'answered_comment_id' => 'nullable'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'header.regex' => 'Can contain only alpha numeric and whitespaces.',
            'description.regex' => 'Can contain only alpha numeric and whitespaces.',
        ];
    }
}
