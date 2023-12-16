<?php

namespace App\Http\Resources\Team;

use App\Http\Resources\Position\PositionResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeamResource extends JsonResource
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
            "positions" => PositionResource::collection($this->Positions)
        ];
    }
}
