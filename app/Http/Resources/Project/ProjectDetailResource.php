<?php

namespace App\Http\Resources\Project;

use App\Enums\BoolStatus;
use App\Http\Resources\City\CityResource;
use App\Http\Resources\Contractor\ContractorResource;
use App\Http\Resources\Gallery\GalleryResource;
use App\Http\Resources\Province\ProvinceResource;
use App\Http\Resources\Tag\TagResource;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Morilog\Jalali\Jalalian;

class ProjectDetailResource extends JsonResource
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
            "startedAt" => Jalalian::forge(convertShamsiToMiladi($this->started_at))->format('%B %d، %Y'),
            "finishedAt" => $this->finished_at ? Jalalian::forge(convertShamsiToMiladi($this->finished_at))->format('%B %d، %Y') : null,
            // "location" => $this->location,
            "location" => (object)["lat" => $location[0],"lang" => $location[1]],
            "province" => $this->Province->name,
            "city" => $this->City->name,
            "isContractor" => $this->is_contractor == BoolStatus::yes ? "yes" : "no",
            "contractorInfo" => $this->is_contractor == BoolStatus::yes ? Company::first()->name : "مشترک با،".$this->Contractor->name,
            "contractDuration" => $this->contract_duration,
            "summery" => $this->summery,
            "description" => $this->description,
            "tags" => TagResource::collection($this->Tags),
            "gallery" => GalleryResource::collection($this->Galleries),
            "createdAt" => Jalalian::forge($this->created_at)->format('%B %d، %Y'),
            "updatedAt" => convertDateToFarsi($this->updated_at)
        ];
    }
}
