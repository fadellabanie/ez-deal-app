<?php

namespace Database\Factories;

use App\Models\RealEstate;
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
            'code' => generateRandomCode('real'),
            'realestate_type_id' => $this->faker->randomElement([1, 2]),
            'city_id' => $this->faker->randomElement([1, 2]),
            'country_id' => 1,
            'price' => $this->faker->randomNumber(3),
            'ar_name' => $this->faker->name,
            'en_name' => $this->faker->name,
            'guest_type' => $this->faker->randomElement([RealEstate::GUEST_TYPE_FAMILY, RealEstate::GUEST_TYPE_MENS,]),
            'guest_count' => $this->faker->numberBetween(10, 100),
            'is_sleep' => true,
            'wc_count' => $this->faker->numberBetween(1, 10),
            'wc_prepared' => true,
            'space' => $this->faker->randomNumber(3),
            'description' => $this->faker->sentence(),
            'leave_time' => date('H:i:s', rand(1, 54000)),
            'enter_time' => date('H:i:s', rand(1, 54000)),
            'note' => $this->faker->sentence(),
            'number_of_views' => $this->faker->numberBetween(10, 100),
            'status' => $this->faker->randomElement([RealEstate::STATUS_SHOW, RealEstate::STATUS_HIDEN,]),
            'is_active' => $this->faker->randomElement([1, 0]),
            'bed_room' => $this->faker->numberBetween(10, 20),
            'living_room' => $this->faker->numberBetween(10, 20),
            'lat' => $this->faker->latitude(),
            'lng' => $this->faker->latitude(),
            'address' => $this->faker->sentence(),
            'large_bed_count' => $this->faker->numberBetween(10, 20),
            'kitchen_count' => $this->faker->numberBetween(10, 20),
            'smail_bed_count' => $this->faker->numberBetween(10, 20),
            'kitchen_prepared' => true,
            'image' => $this->faker->imageUrl(),
            'is_reserved' =>  $this->faker->randomElement([1, 0]),
            'is_overnight' =>  $this->faker->randomElement([1, 0]),
        ];
    }
}
