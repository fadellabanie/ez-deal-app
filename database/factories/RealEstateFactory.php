<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RealEstateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'owner_id',
            'realestate_type_id',
            'city_id',
            'country_id',
            'price',
            'name',
            'space',
            'description',
            'room',
            'wc',
            'guests',
            'bed',
            'leave_time',
            'enter_time',
            'note',
            'number_of_views',
            'status',
            'lat',
            'lng',
            'address',
            'is_reserved',
        ];
    }
}
