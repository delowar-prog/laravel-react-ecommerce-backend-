<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upazila extends Model
{
    /** @use HasFactory<\Database\Factories\UpazilaFactory> */
    use HasFactory;
    protected $fillable = [
        'name',
        'bn_name',
        'url',
        'status',
        'district_id',
    ];
    public function scopeFilter($builder, $request)
    {
        if (! is_object($request)) {
            $request = (object) $request;
        }

        $builder->when($request->search, function ($query) use ($request) {
            $query->where('name', 'like', '%'.$request->search.'%');
        });
        $builder->when($request->district_id, function ($query) use ($request) {
            $query->where('district_id', $request->district_id);
        });
        $builder->latest();
        if ($request->all ?? false) {
            $take = $request->get('take');
            if ($take) {
                $builder->take($take);
            }
        }
    }
    public function district()
    {
        return $this->belongsTo(District::class);
    }
}
