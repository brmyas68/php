<?php

namespace App\Http\Requests\Weblog;

use Illuminate\Foundation\Http\FormRequest;

class WeblogRequest extends FormRequest
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
            ] : [
                "required",
                "image",
                "mimes:png,jpg,jpeg,svg,webp",
                "max:10240"
            ],
            "subject" => [
                "required",
                "string"
            ],
            "categoryId" => [
                "required",
                "numeric",
                "exists:categories,id"
            ],
            "serviceId" => [
                "nullable",
                "string",
                "exists:services,id"
            ],
            "description" => [
                "required",
                "string"
            ],
            "tagsList" => [
                "required",
                "array"
            ],
            "tagsList.*" => [
                "required",
                "string",
                "exists:tags,id"
            ]
        ];
    }
}
