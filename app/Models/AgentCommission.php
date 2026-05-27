<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentCommission extends Model
{
    use HasFactory;

    protected $fillable = [
        'agent_id', 'customer_policy_id', 'insurance_product_id',
        'premium_amount', 'commission_percentage', 'commission_amount',
        'status', 'paid_at', 'payment_transaction_id',
    ];

    protected $casts = ['paid_at' => 'datetime'];

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

    public function customerPolicy()
    {
        return $this->belongsTo(CustomerPolicy::class);
    }

    public function insuranceProduct()
    {
        return $this->belongsTo(InsuranceProduct::class);
    }
}
