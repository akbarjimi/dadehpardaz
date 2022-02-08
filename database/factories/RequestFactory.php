<?php

namespace Database\Factories;

use App\Enum\Banks;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

class RequestFactory extends Factory
{
    public function definition()
    {
        return [
            'category_id' => Category::inRandomOrder()->first()->id,
            'national_id' => User::inRandomOrder()->first()->national_id,
            'desc' => $this->faker->sentence(),
            'amount' => \rand(1000, 1000000),
            'sheba' => Arr::random([Banks::MELLAT, Banks::MELLI, Banks::PASARGAD,]) .'345678901234567890123456',
            'paid_at' => $paid = \rand(0,1) ? now() : null,
            'rejected_at' => $reject = ($paid === null && rand(0,1)) ? now() : null,
            'rejection_reason' => $reject !== null ? $this->faker->sentence() : null,
            'approved_at' => ($reject === null && rand(0, 1)) ? now() : null,
        ];
    }
}
