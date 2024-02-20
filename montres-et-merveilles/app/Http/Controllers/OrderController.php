<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\QuantityItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function payment()
    {
        if (!Auth::check()) {
            return redirect()->intended(route("accueil.index"));
        }

        $user = Auth::user();

        $cart = $user->cart();

        if ($cart->quantityItems->count() == 0) {
            return redirect()->intended(route("accueil.index"));
        }

        $cart->save();

        return view('order.payment', ['quantityItems' => $cart->quantityItems, 'totalPrice' => $this->calculateTotalPrice($cart->quantityItems)]);
    }

    public function doPayment(Request $request)
    {
        $postReceived = $request->validate([
            "card_name" => ["required"],
            "card_number" => ["required"],
            "expiration_date" => ["required"],
            "cvv" => ["required"],
        ]);

        // Je récupère l'utilisateur ainsi que l'id de son panier
        $user = Auth::user();

        $cart = $user->cart();

        // Création d'une nouvelle commande
        $newOrder = Order::create([
            "user_id" => $user->id,
            "price" => $this->calculateTotalPrice($cart->quantityItems)
        ]);

        // Récupérer tous les QuantityItems associés au panier de l'utilisateur donnée
        $quantityItems = QuantityItem::where('cart_id', $cart->id)->get();

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

    private function calculateTotalPrice($quantityItems)
    {
        $totalPrice = 0;

        foreach ($quantityItems as $quantityItem) {
            $totalPrice += $quantityItem->product->price * $quantityItem->quantity;
        }

        return $totalPrice;
    }
}
