<?php

namespace App\Http\Requests\SocialMedia;

use Illuminate\Foundation\Http\FormRequest;

class SocialMediaRequest extends FormRequest
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
                "string",
                "persian_alpha",
                "unique:social_media,name,".$this->id
            ],
            "icon" => $this->id ? [
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
            "username" => [
                "required",
                "string"
            ],
            "link" => [
                "required",
                "string",
                "a_url",
                "unique:social_media,link,".$this->id
            ]
        ];
    }
}
