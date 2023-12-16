<?php

namespace App\Http\Resources\WorkingDaysHours;

use App\Enums\DaysHoursStatus;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkingDaysHoursResource extends JsonResource
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
            "day" => $this->day,
            "status" => $this->status == DaysHoursStatus::open ? "باز" : "بسته",
            "startWork" => $this->start_work,
            "endWork" => $this->end_work,
            "updatedAt" => convertDateToFarsi($this->updated_at)
        ];
    }
}
