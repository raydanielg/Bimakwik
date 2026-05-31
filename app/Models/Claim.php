<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Claim extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'customer_policy_id',
        'claim_number',
        'claim_type',
        'accident_date',
        'description',
        'claimed_amount',
        'approved_amount',
        'status',
        'fraud_score',
        'fraud_alert',
        'rejection_reason',
        'settled_at',
    ];

    protected $casts = [
        'accident_date' => 'date',
        'claimed_amount' => 'decimal:2',
        'approved_amount' => 'decimal:2',
        'fraud_alert' => 'boolean',
        'settled_at' => 'datetime',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function policy(): BelongsTo
    {
        return $this->belongsTo(CustomerPolicy::class, 'customer_policy_id');
    }

    public function documents()
    {
        return $this->hasMany(ClaimDocument::class);
    }
}
