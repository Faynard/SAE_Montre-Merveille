<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public static array $movements = ['Automatique', 'Manual', 'Quartz'];
    public static array $materials = ['Or', 'Argent', 'Acier', 'Bois'];

    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'size',
        'movement',
        'material',
    ];
}
