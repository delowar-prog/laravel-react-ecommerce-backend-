<?php

namespace App\Models;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    /** @use HasFactory<\Database\Factories\ProductDetailFactory> */
    use HasFactory;
   protected $fillable = [
        'product_id',
        'img1',
        'img2',
        'img3',
        'img4',
        'description',
        'size',
        'color'
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
