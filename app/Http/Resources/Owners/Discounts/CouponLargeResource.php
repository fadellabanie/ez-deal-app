<?php

namespace App\Http\Resources\Owners\Discounts;

use App\Models\RealEstate;
use App\Http\Resources\Constants\ImageResource;
use App\Http\Resources\Constants\PricesResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Constants\AttributesResource;

class DiscountLargeResource extends JsonResource
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
            'weekly_discount' => $this->weekly_discount,
            'monthly_discount' => $this->monthly_discount,
            'status' => (bool)$this->status,
        ];
    }
}
