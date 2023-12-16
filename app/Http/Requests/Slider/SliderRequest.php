<?php

namespace App\Http\Requests\Slider;

use App\Enums\BoolStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SliderRequest extends FormRequest
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
            "file" => $this->id ? [
                "nullable",
                "mimes:mp4,png,jpg,jpeg,svg,webp",
                "max:10240"
            ] : [
                "required",
                "mimes:mp4,png,jpg,jpeg,svg,webp",
                "max:10240"
            ],
            "mobileFile" => $this->id ? [
                "nullable",
                "mimes:mp4,png,jpg,jpeg,svg,webp",
                "max:10240"
            ] : [
                "required",
                "mimes:mp4,png,jpg,jpeg,svg,webp",
                "max:10240"
            ],
            "title" => [
                "required",
                "string"
            ],
            "link" => [
                "nullable",
                "string",
                "a_url"
            ],
            "order" => [
                "required",
                "numeric"
            ],
            "isActive" => $this->id ? [
                "required",
                "string",
                Rule::in(BoolStatus::ALL)
            ] : [
                "nullable"
            ]
        ];
    }
}
