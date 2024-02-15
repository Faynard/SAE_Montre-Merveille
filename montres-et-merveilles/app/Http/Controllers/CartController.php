<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\QuantityItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $parameters = $request->validate([
            "product_id" => "required|exists:products,id"
        ]);

        $product = Product::find($parameters["product_id"]);

        $cart = $this->getUserCart(Auth::user()->id);

        $quantityItem = $this->getQuantityItem($cart->id, $product->id);
        $quantityItem->quantity++;

        $quantityItem->save();

        return redirect()->to(route("product.show", $product->id));
    }

    private function getUserCart(int $user_id): Cart
    {
        $cart = Cart::where('user_id', $user_id)->first();

        if (!$cart) {
            $cart = new Cart();
            $cart->user_id = $user_id;

            $cart->save();
        }

        return $cart;
    }

    private function getQuantityItem(int $cart_id, int $product_id): QuantityItem
    {
        $quantityItem = QuantityItem::where('cart_id', $cart_id)->where('product_id', $product_id)->first();

        if (!$quantityItem) {
            $quantityItem = new QuantityItem();

            $quantityItem->quantity = 0;
            $quantityItem->product_id = $product_id;
            $quantityItem->cart_id = $cart_id;

            $quantityItem->save();
        }

        return $quantityItem;
    }
}
