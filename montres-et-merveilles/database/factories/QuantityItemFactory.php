<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class QuantityItemFactory extends Factory
{
    public function definition(): array
    {
        return [
            'product_id' => fake()->numberBetween(1, 10000),
            'quantity' => fake()->numberBetween(1, 10),
        ];
    }
}
