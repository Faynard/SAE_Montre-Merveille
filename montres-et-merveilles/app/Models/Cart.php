<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    //  Permet d'accéder aux QuantityItems lié à un panier
    public function quantityItems()
    {
        return $this->hasMany(QuantityItem::class);
    }

    protected $fillable = [
        'id_user'
    ];
}
