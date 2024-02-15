<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Database\Factories\ProductFactory;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index(): void
    {
        $products = Product::factory()->count(3)->create();

        $response = $this->get(route('product.index'));

        $response->assertStatus(200);

        foreach ($products as $product) {
            $response->assertSee($product->name);
        }
    }

    public function test_show_product_exists(): void
    {
        $product = Product::factory()->create();

        $response = $this->get(route('product.show', ["product" => $product->id]));

        $response->assertStatus(200);
        $response->assertSee($product->name);
    }

    public function test_show_product_not_exists(): void
    {
        $response = $this->get(route('product.show', ["product" => -1]));

        $response->assertStatus(404);
    }
}
