<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceProviderBankDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_provider_id',
        'bank_name',
        'account_name',
        'account_number',
        'branch',
        'swift_code',
        'tax_id',
        'payment_method',
        'minimum_payment_amount',
        'payment_frequency',
    ];

    protected $casts = [
        'minimum_payment_amount' => 'decimal:2',
    ];

    public function serviceProvider(): BelongsTo
    {
        return $this->belongsTo(User::class, 'service_provider_id');
    }
}
