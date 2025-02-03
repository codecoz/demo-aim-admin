<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'status'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'stock' => 'integer',
        'status' => 'boolean'
    ];
}
