<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PremiumFinancingRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id', 'customer_policy_id', 'premium_amount', 'financing_amount',
        'interest_rate', 'repayment_months', 'monthly_installment', 'status',
        'premium_financing_partner_id', 'approved_at',
    ];

    protected $casts = ['approved_at' => 'datetime'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function customerPolicy()
    {
        return $this->belongsTo(CustomerPolicy::class);
    }

    public function financingPartner()
    {
        return $this->belongsTo(FinancingPartner::class, 'premium_financing_partner_id');
    }
}
