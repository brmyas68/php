<?php

namespace App\Http\Resources\City;

use App\Http\Resources\Province\ProvinceResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
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
            "slug" => $this->slug,
            "province" => ProvinceResource::make($this->Province),
            "createdAt" => convertDateToFarsi($this->created_at),
            "updatedAt" => convertDateToFarsi($this->updated_at)
        ];
    }
}
