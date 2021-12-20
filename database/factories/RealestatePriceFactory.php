<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RealestatePriceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'day_id' => $this->faker->randomElement([1, 2, 3, 4, 5, 6, 7]),
            'price' => $this->faker->randomNumber(3),
        ];
    }
}
