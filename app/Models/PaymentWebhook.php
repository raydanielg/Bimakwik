<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaymentWebhook extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_gateway_id',
        'transaction_id',
        'event_type',
        'payload',
        'processed',
        'processed_at',
        'response',
    ];

    protected $casts = [
        'payload' => 'array',
        'processed' => 'boolean',
        'processed_at' => 'datetime',
        'response' => 'array',
    ];

    public function paymentGateway(): BelongsTo
    {
        return $this->belongsTo(PaymentGateway::class);
    }

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(PaymentTransaction::class, 'transaction_id');
    }

    public function scopeProcessed($query)
    {
        return $query->where('processed', true);
    }

    public function scopeUnprocessed($query)
    {
        return $query->where('processed', false);
    }
}
