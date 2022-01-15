<?php

namespace App\Http\Resources\Customers\Entertainments;

use App\Http\Resources\Constants\ImageResource;
use App\Http\Resources\Constants\PricesResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Constants\AttributesResource;

class EntertainmentResource extends JsonResource
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
            'title' => $this->title,
            'mobile' => $this->mobile,
            'rate' => $this->rate,
            'address' => $this->address,
            'lat' => $this->lat,
            'lng' => $this->lng,
            'type' => $this->type,
            'from' => $this->from,
            'to' => $this->to,
            'image' => asset($this->image),
        ];
    }
}
