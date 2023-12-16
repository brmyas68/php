<?php

namespace App\Http\Requests\Search;

use App\Enums\ProjectType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProjectByTypeRequest extends FormRequest
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
            "type" => [
                "required",
                "string",
                Rule::in(["all",ProjectType::done,ProjectType::doing])
            ],
            "searchedText" => [
                "required",
                "string"
            ]
        ];
    }
}
