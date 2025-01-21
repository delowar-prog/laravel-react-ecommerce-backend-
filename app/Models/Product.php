<?php

namespace App\Models;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;
    protected $fillable = ['title', 'short_des', 'price', 'discount', 'discount_price', 'image', 'stock', 'star', 'remarks', 'category_id', 'brand_id'];

    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function brand(){
        return $this->belongsTo(Brand::class);
    }
}
