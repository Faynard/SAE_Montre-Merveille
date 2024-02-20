<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuantityItem extends Model
{
    use HasFactory;

    //  Permet d'accéder à un produit lié à un QuantityItem
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    //  Permet d'accéder à un potentiel panier lié à un QuantityItem
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    //  Permet d'accéder à une potentielle commande lié à un QuantityItem
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
