<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class VideoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'an_name' => $this->faker->word,
            'en_name' => $this->faker->word,
            'url' => $this->faker->url,
        ];
    }
}
