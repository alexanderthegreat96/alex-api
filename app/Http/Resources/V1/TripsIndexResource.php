<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class TripsIndexResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->removeMissingValues([
               'id' => $this->id,
               'title' => $this->title,
               'description' => $this->description,
               'slug' => $this->slug,
               'price' => $this->price,
               'start_date' => $this->start_date,
               'end_date' => $this->end_date,
               'link' => $request->fullUrl().'/'.$this->slug,
               'available' => $this->user() ? false:true
           ]);
    }
}
