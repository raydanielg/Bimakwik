<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancingRepaymentSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'financing_loan_id', 'installment_number', 'due_date', 'installment_amount',
        'principal_portion', 'interest_portion', 'paid_amount', 'paid_at',
        'payment_transaction_id', 'status', 'late_fee_amount',
    ];

    protected $casts = ['due_date' => 'date', 'paid_at' => 'datetime'];

    public function loan()
    {
        return $this->belongsTo(FinancingLoan::class, 'financing_loan_id');
    }
}
