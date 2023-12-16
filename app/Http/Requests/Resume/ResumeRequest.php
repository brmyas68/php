<?php

namespace App\Http\Requests\Resume;

use App\Enums\BoolStatus;
use App\Enums\Sex;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ResumeRequest extends FormRequest
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
            "resume" => [
                "required",
                "file",
                "mimes:pdf",
                "max:10240"
            ],
            "name" => [
                "required",
                "string"
            ],
            "lastName" => [
                "required",
                "string"
            ],
            "birthday" => [
                "nullable",
                "date_format:Y-m-d",
            ],
            "sex" => [
                "required",
                "string",
                Rule::in(Sex::ALL)
            ],
            "mobile" => [
                "required",
                "ir_mobile"
            ],
            "email" => [
                "nullable",
                "email"
            ],
            "lastJobTitle" => [
                "nullable",
                "string"
            ],
            "organizationName" => [
                "nullable",
                "string"
            ],
            "activityInOrganization" => [
                "nullable",
                "string"
            ],
            "stillWork" => [
                "nullable",
                Rule::in(BoolStatus::ALL)
            ],
            "startDate" => [
                "nullable",
                "date_format:Y-m-d",
            ],
            "finishDate" => [
                "nullable",
                "required_if:".$this->stillWork.",".BoolStatus::yes,
                "date_format:Y-m-d",
            ],
            "description" => [
                "nullable",
                "string"
            ]
        ];
    }
}
