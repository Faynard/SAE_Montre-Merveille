<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();

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
}
