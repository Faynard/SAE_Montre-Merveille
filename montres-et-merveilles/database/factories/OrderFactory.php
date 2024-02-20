<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class OrderFactory extends Factory
{
    public function definition(): array
    {
        return [
            'price' => fake()->numberBetween(10, 10000),
            'user_id' => fake()->numberBetween(1, 10000),
        ];
    }
}
