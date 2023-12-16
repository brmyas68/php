<?php

namespace App\Http\Resources\Slider;

use App\Http\Resources\Project\ProjectResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SliderResource extends JsonResource
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
            "file" => $this->file ? asset("storage/".$this->file) : null,
            "type" => $this->type,
            "mobileFile" => $this->mobile_file ? asset("storage/".$this->mobile_file) : null,
            "mobileType" => $this->mobile_file_type,
            "title" => $this->title,
            "link" => $this->link,
            "order" => $this->order,
            "project" => $this->project_id ? ProjectResource::make($this->Project) : null,
            "updatedAt" => convertDateToFarsi($this->updated_at)
        ];
    }
}
