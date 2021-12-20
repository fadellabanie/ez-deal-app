<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RealestateAttributeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'attribute_id' => $this->faker->randomElement([1, 2, 3, 4, 5, 6, 7]),
        ];
    }
}
