<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        //  Indique les valeurs par défaut des filtres
        $request->mergeIfMissing(["name" => '', "size" => 0, "movement" => null, "material" => null]);
        $filters = $request->only(['name', 'size', 'movement', 'material']);

        //  Au lieu de récupérer tout les produits et de les trier après,
        //      on ajoute des clauses WHERE directement dans le code SQL de la requête
        //      si les filtres sont appliqués
        //  products_filtered effectue ceci, et retourne les éléments filtrés
        $products_query = DB::table('products');

        //  Ajoute des clauses WHERE pour chaque filtre s'ils ont une valeur
        foreach ($filters as $field => $value) {
            if ($value) {
                switch ($field) {
                    case 'name':
                        //  Permet de faire une recherche par nom insensible à la casse
                        //  Nous aurions pu aussi utiliser ILIKE
                        //      $products_query->where('name', 'ilike', '%' . $value . '%');
                        //  Mais cet opérateur n'est pas supporté sur SQLITE, nos tests auraient donc échoués à cause de cela
                        $products_query->where(DB::raw('lower(name)'), 'like', '%' . strtolower($value) . '%');
                        break;
                    case 'size':
                        $products_query->where('size', '<=', $value);
                        break;
                    case 'movement':
                    case 'material':
                        $products_query->where($field, $value);
                        break;
                }
            }
        }

        // nombre d'éléments par page
        $page_length = 9;
        $page = $request->input('page', 1);

        if (!is_numeric($page) || $page < 1) {
            abort(400);
        }

        $products = $products_query->offset(($page - 1) * $page_length)->limit($page_length)->get();

        // recuperer le nombre de produits dans la base de données pour savoir combien de pages on doit afficher
        $products_count = Product::count();
        $nb_pages = (int) ceil($products_count / $page_length);

        //  Retourne la vue avec les données de page, produits et de filtres
        return view("product.catalog", array_merge(compact('page', 'nb_pages', 'products_count', 'products'), $filters));
    }

    //  Récupère le produit via l'ID renseigné en paramètre afin de le renseigner dans la vue product
    //      S'il n'existe pas, on renvoie un erreur 404
    public function show(int $id)
    {
        $product = Product::find($id);

        if (!$product) {
            abort(404);
        }

        return view('product.product', ['product' => $product]);
    }

    //  Récupère le produit via l'ID renseigné en paramètre afin de le supprimer
    //      S'il n'existe pas, on renvoie un erreur 404
    public function delete(int $product)
    {
        $product = Product::find($product);

        if (!$product) {
            abort(404);
        }

        $product->delete();

        return redirect()->route("product.index")->with(["hasNotification" => true, "notificationTitle" => "Suppression", "notificationContent" => "Le produit a bien été supprimé"]);
    }
}
