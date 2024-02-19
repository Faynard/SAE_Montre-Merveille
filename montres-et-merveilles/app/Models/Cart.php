<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    public function quantityItems()
    {
        return $this->hasMany(QuantityItem::class);
    }

    protected $fillable = [
        'id_user'
    ];
}
