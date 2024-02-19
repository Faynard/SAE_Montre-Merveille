<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class AdminControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function test_index_not_admin(): void
    {
        $user = User::factory()->create();
        Auth::login($user);

        $response = $this->followingRedirects()->get(route("admin.index"));

        $response->assertStatus(200);
        $response->assertViewIs("accueil");
    }

    public function test_index(): void
    {
        $user = User::factory()->set('role', 'admin')->create();
        Auth::login($user);

        $response = $this->followingRedirects()->get(route("admin.index"));

        $response->assertViewIs("admin.admin");
    }

    public function test_product_create(): void
    {
        $user = User::factory()->set('role', 'admin')->create();
        Auth::login($user);

        $response = $this->followingRedirects()->get(route("admin.product.create"));

        $response->assertViewIs("admin.productForm");
    }

    public function test_product_edit_not_found(): void
    {
        $user = User::factory()->set('role', 'admin')->create();
        Auth::login($user);

        $response = $this->followingRedirects()->get(route("admin.product.edit", ["id" => 0]));

        //  à changer
        $response->assertServerError();
    }

    public function test_product_edit(): void
    {
        $user = User::factory()->set('role', 'admin')->create();
        Auth::login($user);

        $product = Product::factory()->create();

        $response = $this->followingRedirects()->get(route("admin.product.edit", ["id" => $product->id]));

        $response->assertViewIs("admin.productForm");
        $response->assertSee($product->name);
    }

    public function test_product_save_invalid(): void
    {
        $user = User::factory()->set('role', 'admin')->create();
        Auth::login($user);

        $data = Product::factory()->definition();
        $data["name"] = "";

        $this->assertDatabaseCount("products", 0);

        $response = $this->followingRedirects()->post(route("admin.product.save"), $data);

        $this->assertDatabaseCount("products", 0);
    }

    public function test_product_save_invalid_enum(): void
    {
        $user = User::factory()->set('role', 'admin')->create();
        Auth::login($user);

        $data = Product::factory()->definition();
        $data["movement"] = "BLA BLA BLA BLA";

        $this->assertDatabaseCount("products", 0);

        $response = $this->followingRedirects()->post(route("admin.product.save"), $data);

        $this->assertDatabaseCount("products", 0);
    }

    public function test_product_save(): void
    {
        $user = User::factory()->set('role', 'admin')->create();
        Auth::login($user);

        $data = Product::factory()->definition();

        $this->assertDatabaseCount("products", 0);

        $response = $this->followingRedirects()->post(route("admin.product.save"), $data);

        $this->assertDatabaseCount("products", 1);
        $response->assertViewIs("product");
    }
}
