<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zakat extends Model
{
    protected $fillable = [
        'name',
        'income',
        'gold_weight',
        'silver_weight',
        'cash',
        'animals',
        'trade_goods',
        'savings',
        'total_asset',
        'nisab',
        'zakat_amount',
        'zakat_type',
    ];

    protected $casts = [
        'income' => 'decimal:2',
        'gold_weight' => 'decimal:2',
        'silver_weight' => 'decimal:2',
        'cash' => 'decimal:2',
        'animals' => 'decimal:2',
        'trade_goods' => 'decimal:2',
        'savings' => 'decimal:2',
        'total_asset' => 'decimal:2',
        'nisab' => 'decimal:2',
        'zakat_amount' => 'decimal:2',
    ];
}
