<?php

namespace App\Http\Controllers;

use App\Models\QuantityItem;
use App\Models\Product;
use App\Models\User;
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

        $user = Auth::user();

        $user = User::find($user->id);
        $cart = $user->cart();
        $cart->save();

        $quantityItem = $this->getQuantityItem($cart->id, $product->id);
        $quantityItem->quantity++;

        $quantityItem->save();

        return back();
    }

    public function remove(Request $request)
    {
        $parameters = $request->validate([
            "product_id" => "required|exists:products,id"
        ]);

        $product = Product::find($parameters["product_id"]);

        $user = Auth::user();

        $user = User::find($user->id);
        $cart = $user->cart();
        $cart->save();

        $quantityItem = $this->getQuantityItem($cart->id, $product->id);
        $quantityItem->quantity--;

        // Si la quantité est nulle, on supprime l'item
        if ($quantityItem->quantity <= 0) {
            $quantityItem->delete();
            return back();
        }

        $quantityItem->save();

        return back();
    }

    public function delete(Request $request)
    {
        $parameters = $request->validate([
            "product_id" => "required|exists:products,id"
        ]);

        $product = Product::find($parameters["product_id"]);

        $user = Auth::user();

        $user = User::find($user->id);
        $cart = $user->cart();
        $cart->save();

        $quantityItem = $this->getQuantityItem($cart->id, $product->id);
        $quantityItem->delete();

        return back();
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
