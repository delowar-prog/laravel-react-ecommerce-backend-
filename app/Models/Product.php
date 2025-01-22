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

    public function scopeFilter($builder, $request)
    {
        if (! is_object($request)) {
            $request = (object) $request;
        }

        $builder->when($request->search, function ($query) use ($request) {
            $query->where('name', 'like', '%'.$request->search.'%');
        });

        $builder->when($request->select, function ($query) use ($request) {
            $query->where('category_id', '=', $request->select);
        });


        $builder->latest();

        if ($request->all ?? false) {
            $take = $request->get('take');
            if ($take) {
                $builder->take($take);
            }
        }
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function brand(){
        return $this->belongsTo(Brand::class);
    }
}
