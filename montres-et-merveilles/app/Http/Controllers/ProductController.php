<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        //  Au lieu de récupérer tout les produits et de les trier après,
        //      on ajoute des clauses WHERE directement dans le code SQL de la requête
        //      si les filtres sont appliqués

        //  products_filtered effectue ceci, et retourne les éléments filtrés
        $products = $this->products_filtered(DB::table("products"), [
            "name" => $request->input("name"),
        ]);

        return view("catalog", ["products" => $products]);
    }

    public function show(int $id)
    {

        $product = Product::find($id);

        if (!$product) {
            abort(404);
        }

        return view('product', ['product' => $product]);
    }

    private function products_filtered(Builder $products_query, array $filters)
    {
        if (array_key_exists('name', $filters)) {
            $products_query = $products_query->where('name', 'LIKE', '%' . $filters['name'] . '%');
        }

        return $products_query->get();
    }
}
