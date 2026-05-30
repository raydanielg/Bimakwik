<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceProviderPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_provider_id',
        'claim_id',
        'amount',
        'currency',
        'reference',
        'payment_date',
        'status',
        'notes',
    ];

    protected $casts = [
        'payment_date' => 'datetime',
        'amount' => 'decimal:2',
    ];

    public function serviceProvider(): BelongsTo
    {
        return $this->belongsTo(User::class, 'service_provider_id');
    }

    public function claim(): BelongsTo
    {
        return $this->belongsTo(Claim::class);
    }
}
