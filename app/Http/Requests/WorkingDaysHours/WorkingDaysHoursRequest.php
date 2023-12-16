<?php

namespace App\Http\Requests\WorkingDaysHours;

use App\Enums\DaysHoursStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class WorkingDaysHoursRequest extends FormRequest
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
                "numeric",
                Rule::in(DaysHoursStatus::ALL)
            ],
            "startWork" => [
                "nullable",
                "date_format:H:i",
                "required_if:status,".DaysHoursStatus::open
            ],
            "endWork" => [
                "nullable",
                "date_format:H:i",
                "required_if:status,".DaysHoursStatus::open
            ]
        ];
    }
}
