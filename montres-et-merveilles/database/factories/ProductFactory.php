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
            'price' => fake()->randomFloat(max: 50),
            'size' => fake()->randomFloat(min: 30, max: 69),
            'movement' => fake()->randomElement(Product::$movements),
            'material' => fake()->randomElement(Product::$materials),
        ];
    }
}
