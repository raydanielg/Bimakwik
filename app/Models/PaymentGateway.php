<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentGateway extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'type',
        'is_active',
        'config',
        'api_key',
        'api_secret',
        'merchant_id',
        'environment',
        'webhook_url',
        'supported_currencies',
        'fees',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'config' => 'array',
        'supported_currencies' => 'array',
        'fees' => 'array',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function scopeByEnvironment($query, $environment)
    {
        return $query->where('environment', $environment);
    }
}
