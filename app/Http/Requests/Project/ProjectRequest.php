<?php

namespace App\Http\Requests\Project;

use App\Enums\BoolStatus;
use App\Enums\ProjectType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProjectRequest extends FormRequest
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
            "mobileImage" => [
                "nullable",
                "required_if:".$this->showInSlider.",".BoolStatus::yes,
                "image",
                "mimes:png,jpg,jpeg,svg,webp",
                "max:10240"
            ],
            "video" => [
                "nullable",
                "mimes:mp4",
                "max:20480"
            ],
            "subject" => [
                "required",
                "string"
            ],
            "clientId" => [
                "required",
                "string",
                "exists:clients,id"
            ],
            "serviceId" => [
                "required",
                "string",
                "exists:services,id"
            ],
            "provinceId" => [
                "required",
                "string",
                "exists:provinces,id"
            ],
            "cityId" => [
                "required",
                "string",
                "exists:cities,id"
            ],
            "type" => [
                "required",
                "string",
                Rule::in(ProjectType::ALL)
            ],
            "startedAt" => [
                "required",
                "date_format:Y-m-d"
            ],
            "finishedAt" => [
                $this->type == ProjectType::done ? "required" : "nullable",
                "date_format:Y-m-d"
            ],
            "isContractor" => [
                "required",
                "string",
                Rule::in(BoolStatus::ALL)
            ],
            "contractorId" => [
                $this->isContractor == BoolStatus::yes ? "nullable" : "required",
                "exists:contractors,id"
            ],
            "contractDuration" => [
                "required",
                "string"
            ],
            "location" => [
                "required",
                "string"
            ],
            "summery" => [
                "required",
                "string"
            ],
            "description" => [
                "required",
                "string"
            ],
            "showInSlider" => [
                "required",
                "string",
                Rule::in(BoolStatus::ALL)
            ],
            "tagsList" => [
                "required",
                "array"
            ],
            "tagsList.*" => [
                "required",
                "string",
                "exists:tags,id"
            ],
            "galleries" => $this->id ? [
                "nullable"
            ] : [
                "nullable",
                "array",
                "max:5"
            ],
            "galleries.*" => [
                "required",
                "image",
                "mimes:png,jpg,jpeg,svg,webp",
                "max:10240"
            ],
            "properties" => [
                "nullable",
                "array"
            ],
            "properties.*.key" => [
                "required",
                "string"
            ],
            "properties.*.value" => [
                "required",
                "string"
            ],
        ];
    }
}
