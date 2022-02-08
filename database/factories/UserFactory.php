<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'national_id' => \rand(11111111, 9999999999),
            'name' => $this->faker->name(),
            'email' => $this->faker->safeEmail(),
            'mobile' => $this->faker->phoneNumber(),
        ];
    }
}
