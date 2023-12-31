<?php

namespace App\Http\Resources\Service;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
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
            "image" => $this->image ? asset("storage/".$this->image) : null,
            "name" => $this->name,
            "slug" => $this->slug,
            "description" => $this->description,
            "updatedAt" => convertDateToFarsi($this->updated_at)
        ];
    }
}
