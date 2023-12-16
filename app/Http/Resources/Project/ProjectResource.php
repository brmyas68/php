<?php

namespace App\Http\Resources\Project;

use App\Enums\BoolStatus;
use App\Http\Resources\City\CityResource;
use App\Http\Resources\Contractor\ContractorResource;
use App\Http\Resources\Province\ProvinceResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
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
            "image" => $this->image ? asset("storage/".$this->image) : null,
            "mobileImage" => $this->mobile_image ? asset("storage/".$this->mobile_image) : null,
            "video" => $this->video ? asset("storage/".$this->video) : null,
            "subject" => $this->subject,
            "slug" => $this->slug,
            "client" => $this->Client->name,
            "service" => $this->Service->name,
            "type" => $this->type,
            "startedAt" => $this->started_at,
            "finishedAt" => $this->finished_at,
//            "location" => $this->location,
            "location" => (object)["lat" => $location[0],"lang" => $location[1]],
            "province" => $this->Province->name,
            "city" => $this->City->name,
            "isContractor" => $this->is_contractor == BoolStatus::yes ? "yes" : "no",
            "summery" => $this->summery,
            "description" => $this->description,
            "updatedAt" => convertDateToFarsi($this->updated_at)
        ];
    }
}
