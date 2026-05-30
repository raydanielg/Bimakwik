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
        'policy_id',
        'product_id',
        'claim_number',
        'amount',
        'claim_date',
        'description',
        'status',
        'notes',
    ];

    protected $casts = [
        'claim_date' => 'datetime',
        'amount' => 'decimal:2',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function policy(): BelongsTo
    {
        return $this->belongsTo(CustomerPolicy::class, 'policy_id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(InsuranceProduct::class, 'product_id');
    }

    public function documents()
    {
        return $this->hasMany(ClaimDocument::class);
    }
}
