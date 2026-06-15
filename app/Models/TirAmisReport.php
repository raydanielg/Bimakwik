<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TirAmisReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'claim_id',
        'company_code',
        'sales_code',
        'report_number',
        'report_type',
        'report_data',
        'status',
        'submitted_by_type',
        'submitted_by_id',
        'sent_at',
        'response_code',
        'response_message',
    ];

    protected $casts = [
        'report_data' => 'array',
        'sent_at' => 'datetime',
    ];

    public function claim()
    {
        return $this->belongsTo(Claim::class);
    }

    public function scopePending($q) { return $q->where('status', 'pending'); }
    public function scopeSent($q) { return $q->where('status', 'sent'); }
    public function scopeFailed($q) { return $q->where('status', 'failed'); }
    public function scopeByCompany($q, $code) { return $q->where('company_code', $code); }
    public function scopeByType($q, $type) { return $q->where('report_type', $type); }
}
