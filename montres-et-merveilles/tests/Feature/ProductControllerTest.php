<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function test_index(): void
    {
        $products = Product::factory()->count(3)->create();

        $response = $this->get(route('product.index'));

        $response->assertStatus(200);

        foreach ($products as $product) {
            $response->assertSee($product->name);
        }
    }

    public function test_index_with_page(): void
    {
        $products = Product::factory()->count(12)->create();

        $response = $this->get(route('product.index', ["page" => 2]));

        $response->assertStatus(200);

        for ($i = 9; $i < 12; $i++) {
            $response->assertSee($products[$i]->name);
        }
    }

    public function test_index_with_empty_page(): void
    {
        $products = Product::factory()->count(12)->create();

        $response = $this->get(route('product.index', ["page" => 3]));

        $response->assertStatus(200);
        $response->assertDontSee($products[0]->name);
    }

    public function test_index_with_page_not_defined(): void
    {
        $products = Product::factory()->count(12)->create();

        $response = $this->get(route('product.index'));

        $response->assertStatus(200);

        for ($i = 0; $i < 9; $i++) {
            $response->assertSee($products[$i]->name);
        }
    }

    public function test_index_with_page_not_numeric(): void
    {
        $response = $this->get(route('product.index', ["page" => "not_numeric"]));

        $response->assertStatus(400);
    }

    public function test_index_with_name_filter(): void
    {
        $products = Product::factory()->count(3)->create();

        $response = $this->get(route("product.index", "name=" . $products[0]->name));

        $response->assertStatus(200);
        $response->assertSee($products[0]->name);
    }

    public function test_index_with_material_filter(): void
    {
        $products = Product::factory()->count(3)->create();

        $response = $this->get(route("product.index", "material=" . $products[0]->material));

        $response->assertStatus(200);
        $response->assertSee($products[0]->name);
    }

    public function test_index_with_movement_filter(): void
    {
        $products = Product::factory()->count(3)->create();

        $response = $this->get(route("product.index", "movement=" . $products[0]->movement));

        $response->assertStatus(200);
        $response->assertSee($products[0]->name);
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

    public function test_delete(): void
    {
        $user = User::factory()->set('role', 'admin')->create();
        $product = Product::factory()->create();

        $this->assertDatabaseCount('products', 1);

        $response = $this->followingRedirects()->delete(route("product.delete", ["product" => $product->id]));

        $this->assertDatabaseCount('products', 0);
        $response->assertStatus(200);
        $response->assertViewIs("product.catalog");
    }

    public function test_delete_not_found(): void
    {
        $user = User::factory()->set('role', 'admin')->create();
        $product = Product::factory()->create();

        $this->assertDatabaseCount('products', 1);

        $response = $this->delete(route("product.delete", ["product" => -234]));

        $this->assertDatabaseCount('products', 1);
        $response->assertStatus(404);
    }
}
