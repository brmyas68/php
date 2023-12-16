<?php

namespace App\Http\Requests\Comment;

use App\Enums\CommentType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CommentRequest extends FormRequest
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
            "email" => [
                "required",
                "email"
            ],
            "comment" => [
                "required",
                "string"
            ],
            "parentId" => [
                "nullable",
                "string",
                $this->parentId != 0 ? "exists:comments,id" : null
            ],
            "type" => [
                "required",
                "string",
                Rule::in(CommentType::ALL)
            ],
            "typeId" => [
                "required",
                "string",
                $this->type == CommentType::project ? "exists:projects,id" : "exists:weblogs,id"
            ]
        ];
    }
}
