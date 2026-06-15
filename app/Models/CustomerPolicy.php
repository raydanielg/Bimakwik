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
        'policy_number',
        'customer_id',
        'insurance_product_id',
        'insurer_id',
        'broker_id',
        'agent_id',
        'status',
        'start_date',
        'end_date',
        'premium_amount',
        'premium_frequency',
        'sum_assured',
        'deductible_amount',
        'policy_details',
        'nominees',
        'payment_method',
        'payment_reference',
        'purchased_at',
        'last_renewed_at',
        'cancelled_at',
        'cancellation_reason',
        'company_code',
        'sale_point_code',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'premium_amount' => 'decimal:2',
        'sum_assured' => 'decimal:2',
        'deductible_amount' => 'decimal:2',
        'policy_details' => 'array',
        'nominees' => 'array',
        'purchased_at' => 'datetime',
        'last_renewed_at' => 'datetime',
        'cancelled_at' => 'datetime',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(InsuranceProduct::class, 'insurance_product_id');
    }

    public function insurer(): BelongsTo
    {
        return $this->belongsTo(Insurer::class);
    }

    public function broker(): BelongsTo
    {
        return $this->belongsTo(Broker::class);
    }

    public function agent(): BelongsTo
    {
        return $this->belongsTo(Agent::class);
    }

    public function claims(): HasMany
    {
        return $this->hasMany(Claim::class, 'customer_policy_id');
    }
}
