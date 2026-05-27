<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancingPartner extends Model
{
    use HasFactory;

    protected $table = 'financing_partners';

    protected $fillable = [
        'user_id', 'partner_code', 'partner_name', 'registration_number',
        'tin', 'contact_person', 'phone', 'email', 'address', 'website',
        'logo_url', 'interest_rate', 'max_loan_term_months', 'min_loan_amount',
        'max_loan_amount', 'is_active', 'status', 'approved_by', 'approved_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function loans()
    {
        return $this->hasMany(FinancingLoan::class, 'financing_partner_id');
    }

    public function disbursements()
    {
        return $this->hasMany(FinancingDisbursement::class, 'financing_partner_id');
    }

    public function financingRequests()
    {
        return $this->hasMany(PremiumFinancingRequest::class, 'premium_financing_partner_id');
    }
}
