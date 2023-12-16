<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
            "name" => [
                "required",
                "string"
            ],
            "logo" => [
                "nullable",
                "image",
                "mimes:png,jpg,jpeg,svg,webp",
                "max:10240"
            ],
            "film" => [
                "nullable",
                "mimes:mp4",
                "max:30720"
            ],
            "email" => [
                "required",
                "string",
                "email"
            ],
            "phone" => [
                "required",
                "string",
                "ir_phone_with_code"
            ],
            "mobile" => [
                "nullable",
                "string",
                "ir_mobile:zero"
            ],
            "slogan" => [
                "required",
                "string"
            ],
            "startYear" => [
                "required",
                "numeric"
            ],
            "location" => [
                "required",
                "string"
            ],
            "address" => [
                "required",
                "string"
            ],
            "description" => [
                "required",
                "string"
            ],
            "saturdayToWednesday" => [
                "required",
                "string"
            ],
            "thursday" => [
                "required",
                "string"
            ]
        ];
    }
}
