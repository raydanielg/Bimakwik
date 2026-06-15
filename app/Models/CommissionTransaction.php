<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CommissionTransaction extends Model
{
    protected $fillable = [
        'customer_policy_id',
        'commission_rate_id',
        'channel_type',
        'recipient_type',
        'recipient_id',
        'premium_amount',
        'rate_value',
        'rate_type',
        'commission_amount',
        'status',
        'paid_at',
        'notes',
    ];

    protected $casts = [
        'rate_value' => 'decimal:4',
        'commission_amount' => 'decimal:2',
        'premium_amount' => 'decimal:2',
        'paid_at' => 'datetime',
    ];

    public function policy(): BelongsTo
    {
        return $this->belongsTo(CustomerPolicy::class, 'customer_policy_id');
    }

    public function rate(): BelongsTo
    {
        return $this->belongsTo(CommissionRate::class, 'commission_rate_id');
    }

    public function scopePending($q)
    {
        return $q->where('status', 'pending');
    }

    public function scopePaid($q)
    {
        return $q->where('status', 'paid');
    }

    public function scopeForRecipient($q, $type, $id)
    {
        return $q->where('recipient_type', $type)->where('recipient_id', $id);
    }
}
