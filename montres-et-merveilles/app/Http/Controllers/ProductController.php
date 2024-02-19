<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\New_;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        //  Au lieu de récupérer tout les produits et de les trier après,
        //      on ajoute des clauses WHERE directement dans le code SQL de la requête
        //      si les filtres sont appliqués
        //  products_filtered effectue ceci, et retourne les éléments filtrés
        $products_query = $this->products_filtered(DB::table("products"), [
            "name" => $request->input("name"),
            "size" => $request->input("size"),
            "movement" => $request->input("movement"),
            "material" => $request->input("material"),
        ]);

        // nombre d'éléments par page
        $page_length = 9;

        $page_index = 1;

        if (array_key_exists('page', $request->all())) {

            $page_input = $request->input('page');
            if (!is_numeric($page_input) || $page_input < 1) {
                abort(400);
            }

            $page_index = $request->input('page');
        }

        $products = $products_query->offset(($page_index - 1) * $page_length)->limit($page_length)->get();

        // recuperer le nombre de produits dans la base de données pour savoir combien de pages on doit afficher
        $products_count = Product::count();
        $pages_count = (int) ceil($products_count / $page_length);

        return view("catalog", [
            "page" => $page_index,
            "nb_pages" => $pages_count,
            "products_count" => $products_count,
            "products" => $products,
            "name" => $request->input("name"),
            "size" => $request->input("size") ?? 0,
            "movement" => $request->input("movement") ?? "",
            "material" => $request->input("material") ?? "",
        ]);
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
        if (array_key_exists('name', $filters) && $filters['name']) {
            $products_query = $products_query->where('name', 'LIKE', '%' . $filters['name'] . '%');
        }

        if (array_key_exists('size', $filters) && $filters['size']) {
            $products_query = $products_query->where('size', '<=', $filters['size']);
        }

        if (array_key_exists('movement', $filters) && $filters['movement']) {
            $products_query = $products_query->where('movement', $filters['movement']);
        }

        if (array_key_exists('material', $filters) && $filters['material']) {
            $products_query = $products_query->where('material', $filters['material']);
        }

        return $products_query;
    }
}
