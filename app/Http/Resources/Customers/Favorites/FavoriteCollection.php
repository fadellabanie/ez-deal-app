<?php

namespace App\Http\Resources\Customers\Favorites;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Customers\RealEstates\RealEstateTinyResource;
use App\Http\Resources\Customers\RealEstates\RealEstateLargeResource;

class FavoriteCollection extends ResourceCollection
{

    public $collects = FavoriteTinyResource::class;

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
