<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "image" => [
                "nullable",
                "image",
                "mimes:png,jpg,jpeg,svg,webp",
                "max:10240"
            ],
            "name" => [
                "required",
                "string"
            ],
            "email" => [
                "required",
                "string",
                "email"
            ],
            "username" => [
                "required",
                "string"
            ],
            "password" => [
                "nullable",
                "min:6",
                "max:15",
                "regex:/[a-z]/",
                "regex:/[A-Z]/",
                "regex:/[0-9]/",
                "regex:/[@$%*#&]/",
                "confirmed"
            ]
        ];
    }
}
