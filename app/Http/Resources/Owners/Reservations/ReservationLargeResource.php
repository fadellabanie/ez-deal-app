<?php

namespace App\Http\Resources\Owners\Reservations;

use App\Models\RealEstate;
use App\Models\Reservations;
use App\Http\Resources\Constants\ImageResource;
use App\Http\Resources\Constants\PricesResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Constants\AttributesResource;

class ReservationLargeResource extends JsonResource
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
            'id' => $this->realestate->id,
            'name' => $this->realestate->name,
            'country' => $this->realestate->country->name,
            'city' => $this->realestate->city?->name ,
            'realestate_type_id' => $this->realestate->realestateType->name,
            'price' => $this->realestate->price,
            'space' => $this->realestate->space,
            'image' => asset($this->realestate->image),
            'guest_type' => $this->realestate->guest_type,
            'guest_count' => $this->realestate->guest_count,
            'is_sleep' => (bool)$this->realestate->is_sleep,
            'wc_count' => $this->realestate->wc_count,
            'wc_prepared' => (bool) $this->realestate->wc_prepared,
            'leave_time' => $this->realestate->leave_time,
            'enter_time' => $this->realestate->enter_time,
            'number_of_views' => $this->realestate->number_of_views,
            'status' => $this->realestate->status,
            'living_room' => $this->realestate->liveing_room,
            'bed_room' => $this->realestate->bed_room,
            'large_bed_count' => $this->realestate->large_bed_count,
            'kitchen_count' => $this->realestate->kitchen_count,
            'smail_bed_count' => $this->realestate->smail_bed_count,
            'kitchen_prepared' => (bool)$this->realestate->kitchen_prepared,
            'is_reserved' => (bool)$this->realestate->is_reserved,
            'is_overnight' => (bool)$this->realestate->is_overnight,
            'note' => $this->realestate->note,
            'description' => $this->realestate->description,
            'note' => $this->realestate->note,
            'address' => $this->realestate->address,
            'lat' => $this->realestate->lat,
            'lng' => $this->realestate->lng,
            'number_of_views' => $this->realestate->number_of_views,
            'reservations_days' => $this->realestate->reservations,
            'created_at' => $this->realestate->created_at->format('Y-m-d'),
            'images' => ImageResource::collection($this->realestate->medias),
            'attributes' => AttributesResource::collection($this->realestate->attributes),
            'prices' => PricesResource::collection($this->realestate->prices),

        ];
    }
}
