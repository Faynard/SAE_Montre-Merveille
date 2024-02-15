<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function show(int $id) {

        $product = Product::find($id);

        return view('product', ['product' => $product]);
    }
}
