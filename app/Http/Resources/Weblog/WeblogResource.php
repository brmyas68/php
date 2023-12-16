<?php

namespace App\Http\Resources\Weblog;

use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Tag\TagResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Morilog\Jalali\Jalalian;

class WeblogResource extends JsonResource
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
            "subject" => $this->subject,
            "slug" => $this->slug,
            "category" => CategoryResource::make($this->Category),
            "service" => $this->service_id ? $this->Service->name : null,
            "description" => $this->description,
            "tags" => TagResource::collection($this->Tags),
            "views" => $this->views,
            "createdAt" => Jalalian::forge($this->created_at)->format('%B %d، %Y'),
            "updatedAt" => convertDateToFarsi($this->updated_at)
        ];
    }
}
