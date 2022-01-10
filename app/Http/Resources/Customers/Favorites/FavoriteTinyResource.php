<?php

namespace App\Http\Resources\Customers\Favorites;

use App\Http\Resources\Constants\ImageResource;
use App\Http\Resources\Constants\PricesResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Constants\AttributesResource;

class FavoriteTinyResource extends JsonResource
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
            'id' => $this->realEstate->id,
            'name' => $this->realEstate->name,
            'country' => $this->realEstate->country->name,
            'city' => $this->realEstate->city->name,
            'realestate_type_id' => $this->realEstate->realestateType->name,
            'price' => $this->realEstate->price,
            'space' => $this->realEstate->space,
            'guest_type' => $this->realEstate->guest_type,
            'guest_count' => $this->realEstate->guest_count,
            'images' => ImageResource::collection($this->realEstate->medias),
            'attributes' => AttributesResource::collection($this->realEstate->attributes),
            'prices' => PricesResource::collection($this->realEstate->prices),        ];
    }
}