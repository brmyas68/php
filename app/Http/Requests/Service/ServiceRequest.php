<?php

namespace App\Http\Requests\Service;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
            "image" => $this->id ? [
                "nullable",
                "image",
                "mimes:png,jpg,jpeg,svg,webp",
                "max:10240"
            ]: [
                "required",
                "image",
                "mimes:png,jpg,jpeg,svg,webp",
                "max:10240"
            ],
            "name" => [
                "required",
                "string"
            ],
            "description" => [
                "nullable",
                "string"
            ]
        ];
    }
}
