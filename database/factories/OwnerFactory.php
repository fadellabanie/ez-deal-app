<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

class OwnerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => generateRandomCode('own'),
            'prefix' => $this->faker->word(),
            'first_name' => $this->faker->name,
            'last_name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'verified_at' => now(),
            'password' => Hash::make(12345678),
            'country_code' => $this->faker->countryCode,
            'mobile' => '0115265' . $this->faker->numerify('#####'),
            'gender' => 1,
            'birthday' => now(),
            'avatar' => $this->faker->imageUrl(),
            'status' => true,
            'account_number' => $this->faker->name,
            'account_name' => $this->faker->swiftBicNumber(),
            'remember_token' => Str::random(10),
            'device_token' => Str::random(10),
        ];
    }
}
