<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CustomerPolicy extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'product_id',
        'policy_number',
        'premium',
        'start_date',
        'end_date',
        'status',
        'coverage_amount',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'premium' => 'decimal:2',
        'coverage_amount' => 'decimal:2',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(InsuranceProduct::class, 'product_id');
    }

    public function claims(): HasMany
    {
        return $this->hasMany(Claim::class);
    }
}
