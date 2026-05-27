<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancingLoan extends Model
{
    use HasFactory;

    protected $fillable = [
        'loan_number', 'customer_id', 'customer_policy_id', 'financing_partner_id',
        'principal_amount', 'interest_rate', 'total_interest', 'total_repayment',
        'term_months', 'monthly_installment', 'status', 'approved_by',
        'approved_at', 'disbursed_at', 'completed_at', 'defaulted_at',
    ];

    public function financingPartner()
    {
        return $this->belongsTo(FinancingPartner::class, 'financing_partner_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function customerPolicy()
    {
        return $this->belongsTo(CustomerPolicy::class);
    }

    public function disbursements()
    {
        return $this->hasMany(FinancingDisbursement::class, 'financing_loan_id');
    }

    public function repaymentSchedules()
    {
        return $this->hasMany(FinancingRepaymentSchedule::class, 'financing_loan_id');
    }

    public function defaults()
    {
        return $this->hasMany(FinancingDefault::class, 'financing_loan_id');
    }
}
