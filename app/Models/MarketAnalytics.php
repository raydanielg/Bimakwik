<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketAnalytics extends Model
{
    use HasFactory;

    protected $fillable = [
        'metric_name',
        'metric_value',
        'category',
        'period',
        'data',
        'notes',
    ];

    protected $casts = [
        'data' => 'array',
    ];
}
