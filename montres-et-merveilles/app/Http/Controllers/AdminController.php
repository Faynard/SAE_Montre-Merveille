<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminController
{
    /*Cette focntion permet de récupérer toute les commandes. Comme findAllOrder() */
    public function index()
    {
        $orders = Order::all();

        return view("admin/admin", ["orders" => $orders]);
    }

    public function deleteOrder(int $id)
    {
        $order = Order::find($id);

        if (!$order) {
            abort(404);
        }

        $order->delete();

        return redirect()->route("admin.index");
    }

    public function createProduct()
    {
        //  Retourne le formulaire du produit avec des valeurs par défaut vides
        return view("admin/productForm", ["product" => new Product()]);
    }

    public function editProduct(int $id)
    {
        //  Retourne le formulaire du produit avec des valeurs par défaut correspondant au produit que l'on veut modifier
        return view("admin/productForm", ["product" => Product::find($id)]);
    }

    public function doSaveProduct(Request $request)
    {
        //  Validation des données en entrée
        $data = $request->validate([
            "name" => ["required"],
            "description" => ["required"],
            "price" => ["required", "integer"],
            "size" => ["required", "integer"],
            "movement" => ["required", Rule::in(Product::$movements)],
            "material" => ["required", Rule::in(Product::$materials)]
        ]);

        $productData = [
            "name" => $data["name"],
            "description" => $data["description"],
            "price" => $data["price"],
            "size" => $data["size"],
            "movement" => $data["movement"],
            "material" => $data["material"],
        ];

        //  Si le champs 'id' est renseigné et différent de 0/null, retrouver le produit avec l'ID renseignée
        //  Sinon, créer un nouveau produit
        //  Puis remplir les informations du produit manipulé avec les informations de la requête
        $product = $request->has("id") && $request["id"] ? Product::find($request->id) : new Product();
        $product->fill($productData)->save();

        return redirect(route('product.show', ["product" => $product->id]));
    }
}
