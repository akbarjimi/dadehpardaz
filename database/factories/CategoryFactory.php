<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->randomElement([
                "حمل و نقل",
                "ایاب و ذهاب",
                "خرید تجهیزات",
                "غیره",
            ]),
        ];
    }
}
