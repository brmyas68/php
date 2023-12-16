<?php

namespace App\Http\Resources\Client;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
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
            "logo" => $this->logo ? asset("storage/".$this->logo) : null,
            "name" => $this->name,
            "updatedAt" => convertDateToFarsi($this->updated_at)
        ];
    }
}
