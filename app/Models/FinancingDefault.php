<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancingDefault extends Model
{
    use HasFactory;

    protected $fillable = [
        'financing_loan_id', 'default_date', 'default_reason', 'outstanding_amount',
        'overdue_days', 'collection_attempts', 'written_off', 'written_off_at', 'notes',
    ];

    public function loan()
    {
        return $this->belongsTo(FinancingLoan::class, 'financing_loan_id');
    }
}
