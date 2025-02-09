<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryItem extends Model
{
    protected $fillable = [
        'name',
        'sku',
        'description',
        'quantity',
        'price',
        'category',
        'metadata'
    ];

    protected $casts = [
        'metadata' => 'array',
        'price' => 'decimal:2',
        'quantity' => 'integer'
    ];
}
