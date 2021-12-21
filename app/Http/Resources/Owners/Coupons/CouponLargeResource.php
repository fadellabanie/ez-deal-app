<?php

namespace App\Http\Resources\Owners\Coupons;

use App\Models\RealEstate;
use App\Http\Resources\Constants\ImageResource;
use App\Http\Resources\Constants\PricesResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Constants\AttributesResource;

class CouponLargeResource extends JsonResource
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
            'code' => $this->code,
            'discount' => $this->discount,
            'from' => $this->from,
            'to' => $this->to,
            'number_of_use' => $this->number_of_use,
            'status' => (bool)$this->status,
        ];
    }
}
