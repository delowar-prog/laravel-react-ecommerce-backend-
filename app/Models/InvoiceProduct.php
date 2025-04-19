<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceProduct extends Model
{
    /** @use HasFactory<\Database\Factories\InvoiceProductFactory> */
    use HasFactory;
    protected $fillable = [
        'invoice_id',
        'product_id',
        'color',
        'size',
        'price',
        'quantity',
    ];
}
