<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCart extends Model
{
    /** @use HasFactory<\Database\Factories\ProductCartFactory> */
    use HasFactory;
    protected $fillable = ['product_id', 'user_id','color','size','quantity', 'price'];
}
