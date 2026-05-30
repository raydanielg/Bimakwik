<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceProviderServiceLevelAgreement extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_provider_id',
        'agreement_number',
        'start_date',
        'end_date',
        'terms',
        'status',
        'sla_metrics',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'sla_metrics' => 'array',
    ];

    public function serviceProvider(): BelongsTo
    {
        return $this->belongsTo(User::class, 'service_provider_id');
    }
}
