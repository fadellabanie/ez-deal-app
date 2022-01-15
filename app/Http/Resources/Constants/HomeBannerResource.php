<?php

namespace App\Http\Resources\Constants;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class HomeBannerResource extends JsonResource
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
            'image' => asset($this->image),
        ];
    }
}