<?php

namespace App\Http\Resources\Company;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $location=explode(",",$this->location);
        return [
          "id" => $this->id,
          "name" => $this->name,
            "logo" => $this->logo ? asset("storage/".$this->logo) : null,
            "film" => $this->film ? asset("storage/".$this->film) : null,
            "email" => $this->email,
            "phone" => $this->phone,
            "mobile" => $this->mobile,
            "slogan" => $this->slogan,
            "startYear" => $this->start_year,
            // "location" => $this->location,
            "location" => (object)["lat" => $location[0],"lang" => $location[1]],
            "address" => $this->address,
            "description" => $this->description,
            "saturdayToWednesday" => $this->saturday_to_wednesday,
            "thursday" => $this->thursday,
            "updatedAt" => convertDateToFarsi($this->updated_at)
        ];
    }
}
