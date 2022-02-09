<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EntertainmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ar_title' => $this->faker->name,
            'en_title' => $this->faker->name,
            'lat' => $this->faker->latitude(),
            'lng' => $this->faker->latitude(),
            'address' => $this->faker->sentence(),
            'image' => $this->faker->imageUrl(),
            'type' => $this->faker->randomElement(['entertainment-places', 'restaurants', 'camps']),
            'from' => now(),
            'to' => now(),
            'mobile' => '0115265' . $this->faker->numerify('#####'),
            'rate' => $this->faker->randomElement([1, 2, 3, 4, 5]),
        ];
    }
}
