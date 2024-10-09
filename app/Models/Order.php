<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'factory_id',
        'quantity',
        'status',
        'price_excluding_tax',
        'tax',
        'total_price',
        'price_per_kg',
        'tax_value',
        'order_date',
    ];
}
