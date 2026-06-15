<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductRisk extends Model
{
    protected $fillable = [
        'insurance_product_id',
        'risk_code',
        'risk_name',
        'product_code',
        'class_of_insurance',
        'minimum_rate',
        'minimum_amount',
        'is_active',
    ];

    protected $casts = [
        'minimum_rate' => 'decimal:4',
        'minimum_amount' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function insuranceProduct(): BelongsTo
    {
        return $this->belongsTo(InsuranceProduct::class);
    }
}
