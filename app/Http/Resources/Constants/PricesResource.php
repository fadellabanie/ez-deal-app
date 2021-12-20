<?php

namespace App\Http\Resources\Constants;

use Illuminate\Http\Resources\Json\JsonResource;

class PricesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
    
        return [
            'id' => $this->id,
            'day' => $this->day,
            'price' => $this->pivot->price,
        ];
    }
}