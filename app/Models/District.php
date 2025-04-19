<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    /** @use HasFactory<\Database\Factories\DistrictFactory> */
    use HasFactory;
    protected $fillable = [
        'name',
        'bn_name',
        'url',
        'status',
        'division_id',
    ];
    public function scopeFilter($builder, $request)
    {
        if (! is_object($request)) {
            $request = (object) $request;
        }

        $builder->when($request->search, function ($query) use ($request) {
            $query->where('name', 'like', '%'.$request->search.'%');
        });
        $builder->when($request->division_id, function ($query) use ($request) {
            $query->where('division_id', $request->division_id);
        });
        $builder->latest();
        if ($request->all ?? false) {
            $take = $request->get('take');
            if ($take) {
                $builder->take($take);
            }
        }
    }
    public function division()
    {
        return $this->belongsTo(Division::class);
    }
}
