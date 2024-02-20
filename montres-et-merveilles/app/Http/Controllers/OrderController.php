<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\QuantityItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function payment()
    {
        if (Auth::check()) {
            $user = Auth::user();

            $cart = $this->getUserCart($user->id);
            return view('order.payment', ['quantityItems' => $cart->quantityItems, 'totalPrice' => $this->calculateTotalPrice($cart->quantityItems)]);
        } else {
            return redirect()->intended(route("accueil.index"));
        }
    }

    public function doPayment(Request $request)
    {
        $postReceived = $request->validate([
            "card_name" => ["required"],
            "card_number" => ["required"],
            "expiration_date" => ["required"],
            "cvv" => ["required"],
        ]);

        $user = Auth::user();

        // Je récupère l'id de l'utilisateur ainsi que l'id de son panier
        $user_id = $user->id;
        $cart = $this->getUserCart($user_id);

        // Création d'une nouvelle commande
        $newOrder = Order::create([
            "user_id" => $user_id,
            "price" => $this->calculateTotalPrice($cart->quantityItems)
        ]);

        // Récupérer l'id du panier de l'utilisateur
        $idCart = $this->getUserCart($user_id)->id;


        // Récupérer tous les QuantityItems associés au panier de l'utilisateur donnée
        $quantityItems = QuantityItem::where('cart_id', $idCart)->get();

        // Mettre à jour l'order_id pour tous les QuantityItems, on délie du panier et crée une liaison avec la nouvelle commande.
        foreach ($quantityItems as $quantityItem) {
            $quantityItem->order_id = $newOrder->id;
            $quantityItem->cart_id = null;
            $quantityItem->save();
        }

        // Supprimer le panier de l'utilisateur
        $cart->delete();

        return redirect()->intended(route("accueil.index"));
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

    private function calculateTotalPrice($quantityItems)
    {
        $totalPrice = 0;

        foreach ($quantityItems as $quantityItem) {
            $totalPrice += $quantityItem->product->price * $quantityItem->quantity;
        }

        return $totalPrice;
    }
}
