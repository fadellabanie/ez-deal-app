<?php

namespace App\Http\Resources\Owners\RealEstates;

use App\Models\RealEstate;
use App\Http\Resources\Constants\ImageResource;
use App\Http\Resources\Constants\PricesResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Constants\AttributesResource;

class RealEstateLargeResource extends JsonResource
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
            'country' => $this->country->name,
            'city' => $this->city?->name ,
            'realestate_type_id' => $this->realestateType->name,
            'price' => $this->price,
            'space' => $this->space,
            'image' => asset($this->image),
            'guest_type' => $this->guest_type,
            'guest_count' => $this->guest_count,
            'is_sleep' => (bool)$this->is_sleep,
            'wc_count' => $this->wc_count,
            'wc_prepared' => (bool) $this->wc_prepared,
       
            'leave_time' => $this->leave_time,
            'enter_time' => $this->enter_time,
            
            'number_of_views' => $this->number_of_views,
            'status' => $this->status,
            'living_room' => $this->liveing_room,
            'bed_room' => $this->bed_room,
            'large_bed_count' => $this->large_bed_count,
            'kitchen_count' => $this->kitchen_count,
            'smail_bed_count' => $this->smail_bed_count,
            'kitchen_prepared' => (bool)$this->kitchen_prepared,
            'is_reserved' => (bool)$this->is_reserved,
            'is_overnight' => (bool)$this->is_overnight,
            'note' => $this->note,
            'description' => $this->description,
            'note' => $this->note,
            'address' => $this->address,
            'lat' => $this->lat,
            'lng' => $this->lng,
            'number_of_views' => $this->number_of_views,
            'created_at' => $this->created_at->format('Y-m-d'),
            'images' => ImageResource::collection($this->medias),
            'attributes' => AttributesResource::collection($this->attributes),
            'prices' => PricesResource::collection($this->prices),

        ];
    }
}
