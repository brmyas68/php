<?php

namespace App\Http\Requests\Resume;

use App\Enums\ResumeStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DownloadResumeRequest extends FormRequest
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
            "status" => [
                "required",
                "string",
                Rule::in([ResumeStatus::undefined,ResumeStatus::rejected,ResumeStatus::confirmed,'3'])
            ]
        ];
    }
}
