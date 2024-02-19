<?php

namespace App\Http\Controllers;

use App\Models\Order;
use http\Client\Curl\User;

class AdminController
{
    /*Cette focntion permet de récupérer toute les commandes. Comme findAllOrder() */
    public function index()
    {
        $orders = Order::all();

        return view("admin", ["orders" => $orders]);
    }
}
