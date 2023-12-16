<?php

namespace App\Http\Resources\SocialMedia;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SocialMediaResource extends JsonResource
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
            "icon" => $this->icon ? asset("storage/".$this->icon) : null,
            "username" => $this->username,
            "link" => $this->link,
            "updatedAt" => convertDateToFarsi($this->updated_at)
        ];
    }
}
