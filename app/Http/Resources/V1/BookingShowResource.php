<?php

namespace App\Http\Resources\V1;

use App\Helpers\ExchangeFacade;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Cache;

class BookingShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $convertedPrice = null;
        if(!Cache::has('convertedPrice_'.$this->id)) {
            $convertedPrice = ExchangeFacade::convertPrice($this->price);
            Cache::add('convertedPrice_'.$this->id,$convertedPrice,60);
        } else {
            $convertedPrice = Cache::get('convertedPrice_'.$this->id);
        }

        return
            [
                'booking_id' => $this->id,
                'trip_id' => $this->trip->id,
                'from_date' => $this->trip->start_date,
                'to_date' => $this->trip->end_date,
                'price' => $this->trip->price. 'EUR',
                'converted_price' => $convertedPrice. ' RON',
                'title' => $this->trip->title
            ];
    }
}
