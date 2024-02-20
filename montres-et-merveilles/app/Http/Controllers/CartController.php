<?php

namespace App\Http\Controllers;

use App\Models\QuantityItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /* ajout d'un article au panier de l'utilisateur,
     * celui-ci doit être connecté.
     * permet aussi l'incrémentation de la quantité d'un article
     * dans le panier de l'utilisateur sur la page associée
     */
    public function add(Request $request)
    {
        $parameters = $request->validate([
            "product_id" => "required|exists:products,id"
        ]);

        $product = Product::find($parameters["product_id"]);

        $user = Auth::user();
        $cart = $user->cart();

        $quantityItem = $this->getQuantityItem($cart->id, $product->id);
        $quantityItem->quantity++;

        $quantityItem->save();

        return back();
    }

    /* suppression d'un article au panier de l'utilisateur,
     * celui-ci devant être connecté.
     * Permet la décrémentation de la quantité d'un article.
     * Si la quantité est nulle, on supprime l'article du panier
     */
    public function remove(Request $request)
    {
        $parameters = $request->validate([
            "product_id" => "required|exists:products,id"
        ]);

        $product = Product::find($parameters["product_id"]);

        $user = Auth::user();
        $cart = $user->cart();

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

    /* suppression d'un article, quelque soit sa quantité, du panier de l'utilisateur,
     * celui-ci devant être connecté.
     * Permet la suppression de la totalité d'un article
     */
    public function delete(Request $request)
    {
        $parameters = $request->validate([
            "product_id" => "required|exists:products,id"
        ]);

        $product = Product::find($parameters["product_id"]);

        $user = Auth::user();
        $cart = $user->cart();

        $quantityItem = $this->getQuantityItem($cart->id, $product->id);
        $quantityItem->delete();

        return back();
    }

    /* récupération de la quantité d'un article dans le panier de l'utilisateur
     * celui-ci devant être connecté
     */
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
