<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'description' => fake()->text,
            'price' => fake()->numberBetween(0, 1000),
            'size' => fake()->numberBetween(30, 69),
            'movement' => fake()->randomElement(Product::$movements),
            'material' => fake()->randomElement(Product::$materials),
        ];
    }
}
