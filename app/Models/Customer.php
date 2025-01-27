<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /** @use HasFactory<\Database\Factories\CustomerFactory> */
    use HasFactory;

    protected $fillable = [
        'cus_name',
        'cus_address',
        'cus_country',
        'cus_division',
        'cus_district',
        'cus_upazila',
        'cus_post_code',
        'cus_phone',
        'cus_email',
        'ship_name',
    ];
}
