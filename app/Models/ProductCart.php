<?php

namespace App\Models;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCart extends Model
{
    /** @use HasFactory<\Database\Factories\ProductCartFactory> */
    use HasFactory;
    protected $fillable = ['product_id', 'user_id','color','size','quantity', 'price'];


    public function product(){
        return $this->belongsTO(product::class);
    }
}
