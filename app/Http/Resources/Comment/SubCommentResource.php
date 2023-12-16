<?php

namespace App\Http\Resources\Comment;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Morilog\Jalali\Jalalian;

class SubCommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "email" => $this->email,
            "comment" => $this->comment,
            $this->type => $this->type_id,
            "parent" => $this->ActiveParent ? $this->ActiveParent->comment : null,
            "children" => $this->ActiveChildren,
            "adminReply" => $this->admin_reply,
            "createdAt" => Jalalian::forge($this->created_at)->format('%B %d، %Y'),
        ];
    }
}
