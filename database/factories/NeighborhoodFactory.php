<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class NeighborhoodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'country_id'=> $this->faker->randomElement([1, 2]),
            'city_id'=> $this->faker->randomElement([1, 2]),
            'ar_name' => $this->faker->name(),
            'en_name' => $this->faker->name(),
            'icon'=> $this->faker->image(),
            'status'=> true
        ];
    }

}
