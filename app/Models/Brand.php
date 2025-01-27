<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    /** @use HasFactory<\Database\Factories\BrandFactory> */
    use HasFactory;

    protected $fillable = ['brandName', 'brandImg'];

    public function scopeFilter($builder, $request)
    {
        if (! is_object($request)) {
            $request = (object) $request;
        }

        $builder->when($request->search, function ($query) use ($request) {
            $query->where('name', 'like', '%'.$request->search.'%');
        });


        $builder->latest();

        if ($request->all ?? false) {
            $take = $request->get('take');
            if ($take) {
                $builder->take($take);
            }
        }
    }
}
