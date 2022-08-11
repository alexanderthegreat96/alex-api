<?php

namespace App\Http\Resources\V1;

use App\Helpers\ExchangeFacade;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Cache;

class TripsShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $available = true;
        if($this->user && $this->user->id) {
            $available = false;
        }


        $convertedPrice = null;
        if(!Cache::has('convertedPrice_'.$this->id)) {
            $convertedPrice = ExchangeFacade::convertPrice($this->price);
            Cache::add('convertedPrice_'.$this->id,$convertedPrice,60);
        } else {
            $convertedPrice = Cache::get('convertedPrice_'.$this->id);
        }

        return $this->removeMissingValues([
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'slug' => $this->slug,
            'price' => $this->price . ' EUR',
            'converted_price'=> $convertedPrice. ' RON',
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'link' => $request->fullUrl().'/'.$this->slug,
            'available' => $available
        ]);
    }
}
