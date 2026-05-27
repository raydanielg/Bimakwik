<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancingDisbursement extends Model
{
    use HasFactory;

    protected $fillable = [
        'financing_loan_id', 'financing_partner_id', 'disbursement_amount',
        'disbursement_reference', 'payment_transaction_id', 'destination_type',
        'destination_details', 'disbursed_by', 'disbursed_at', 'status',
    ];

    public function loan()
    {
        return $this->belongsTo(FinancingLoan::class, 'financing_loan_id');
    }

    public function financingPartner()
    {
        return $this->belongsTo(FinancingPartner::class, 'financing_partner_id');
    }
}
