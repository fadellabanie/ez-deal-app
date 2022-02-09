<?php

namespace App\Http\Resources\Customers\Entertainments;

use Illuminate\Http\Resources\Json\ResourceCollection;

class EntertainmentCollection extends ResourceCollection
{

    public $collects = EntertainmentResource::class;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    
    public function toArray($request)
    {
        return [
            'status' => 1,
            'message' => __('Success Request'),
            'data' => parent::toArray($request),
        ];
    }
}
