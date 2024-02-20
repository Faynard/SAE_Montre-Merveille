<?php

namespace Tests\Feature;

use App\Models\Cart;
use App\Models\Product;
use App\Models\QuantityItem;
use Auth;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use App\Models\User;

class OrderControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function test_payment_not_authentified()
    {
        $response = $this->get(route("order.payment"));

        $response->assertRedirect(route("user.login"));
    }

    public function test_payment_empty_cart()
    {
        $user = User::factory()->create();
        Auth::login($user);

        $response = $this->get(route("order.payment"));

        $response->assertRedirect(route("accueil.index"));
    }

    public function test_payment()
    {
        $product = Product::factory()->create();

        $user = User::factory()->create();
        $cart = Cart::factory()->set("user_id", $user->id)->create();

        QuantityItem::factory()->set("cart_id", $cart->id)->set("product_id", $product->id)->create();

        Auth::login($user);
        $response = $this->followingRedirects()->get(route("order.payment"));

        $response->assertStatus(200);
        $response->assertViewIs("order.payment");
        $response->assertSee($product->name);
    }

    public function test_do_payment_invalid_data()
    {
        $data = [
            "card_name" => "",
            "card_number" => "232424",
            "expiration_date" => "23/23",
            "cvv" => "409",
        ];

        Auth::login(User::factory()->create());

        $this->assertDatabaseCount("orders", 0);

        $response = $this->post(route("order.payment"), $data);

        $this->assertDatabaseCount("orders", 0);
    }

    public function test_do_payment()
    {
        $data = [
            "card_name" => "UN TEST ??",
            "card_number" => "232424",
            "expiration_date" => "23/23",
            "cvv" => "409",
        ];

        $product = Product::factory()->create();

        $user = User::factory()->create();
        $cart = Cart::factory()->set("user_id", $user->id)->create();
        QuantityItem::factory()->set("cart_id", $cart->id)->set("product_id", $product->id)->create();

        Auth::login($user);

        $this->assertDatabaseCount("orders", 0);

        $response = $this->post(route("order.payment"), $data);

        $this->assertDatabaseCount("orders", 1);
        $response->assertRedirect(route("accueil.index"));
    }
}
