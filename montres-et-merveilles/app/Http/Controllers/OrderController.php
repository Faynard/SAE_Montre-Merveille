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
        // Vérifie la connexion de l'utilisateur, s'il est connecté, on retourne la vue payment avec comme paramètres le prix total du panier et les produits du panier
        if (!Auth::check()) {
            return redirect()->intended(route("accueil.index"));
        }

        $user = Auth::user();

        $cart = $user->cart();

        if ($cart->quantityItems->count() == 0) {
            return redirect()->intended(route("accueil.index"));
        }

        return view('order.payment', ['quantityItems' => $cart->quantityItems, 'totalPrice' => $this->calculateTotalPrice($cart->quantityItems)]);
    }

    //  Effectue la validation des données bancaire, et si possible, créer une commande à partir du panier
    public function doPayment(Request $request)
    {
        // Vérifie l'intégrité des données entrées dans le formulaire
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

        return redirect()->intended(route("accueil.index"))->with(["hasNotification" => true, "notificationTitle" => "Paiement", "notificationContent" => "Votre commande a bien été enregistrée"]);
    }

    // Méthode qui retourne le prix total des produits du panier
    private function calculateTotalPrice($quantityItems)
    {
        $totalPrice = 0;

        // Boucle qui aditionne le prix * la quantitié de tous les produits du panier
        foreach ($quantityItems as $quantityItem) {
            $totalPrice += $quantityItem->product->price * $quantityItem->quantity;
        }

        return $totalPrice;
    }
}
