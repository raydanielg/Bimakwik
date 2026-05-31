<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrokerCommission extends Model
{
    use HasFactory;

    protected $fillable = [
        'broker_id',
        'customer_policy_id',
        'insurance_product_id',
        'premium_amount',
        'commission_percentage',
        'commission_amount',
        'status',
        'paid_at',
        'payment_transaction_id',
    ];

    protected $casts = [
        'paid_at' => 'datetime',
        'commission_amount' => 'decimal:2',
        'premium_amount' => 'decimal:2',
    ];

    public function broker()
    {
        return $this->belongsTo(Broker::class);
    }

    public function customerPolicy()
    {
        return $this->belongsTo(CustomerPolicy::class);
    }
}
