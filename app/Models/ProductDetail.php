<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    /** @use HasFactory<\Database\Factories\ProductDetailFactory> */
    use HasFactory;
   protected $fillable = [
        'product_id',
        'size',
        'color',
        'price',
        'stock',
    ];
}
