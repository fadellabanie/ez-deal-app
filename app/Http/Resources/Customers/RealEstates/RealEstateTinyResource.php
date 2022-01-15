<?php

namespace App\Http\Resources\Customers\RealEstates;

use Illuminate\Http\Resources\Json\JsonResource;

class RealEstateTinyResource extends JsonResource
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
            'name' => $this->name,
            'country' => $this->country->name ?? "",
            'city' => $this->city->name ?? "",
            'realestate_type_id' => $this->realestateType->name ?? "",
            'price' => $this->price,
            'lat' => $this->lat,
            'lng' => $this->lng,
            'address' => $this->address,
            'space' => $this->space,
            'image' => asset($this->image),
            'guest_type' => $this->guest_type,
            'guest_count' => $this->guest_count,
            'image' => asset($this->image),
        ];
    }
}