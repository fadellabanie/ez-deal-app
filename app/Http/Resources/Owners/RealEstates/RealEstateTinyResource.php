<?php

namespace App\Http\Resources\Owners\RealEstates;

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
            'realestate_type' => $this->realestateType->name,
            'price' => $this->price,
            'address' => $this->address,
            'name' => $this->name,
            'description' => $this->description,  
            'rate' => $this->rate,
            'image' => asset($this->image),
        ];
    }
}