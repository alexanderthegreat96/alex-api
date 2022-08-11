<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class BookingIndexResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return
            [
                'booking_id' => $this->id,
                'trip_id' => $this->trip->id,
                'from_date' => $this->trip->start_date,
                'to_date' => $this->trip->end_date
            ];
    }
}
