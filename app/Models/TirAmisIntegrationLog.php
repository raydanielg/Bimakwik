<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TirAmisIntegrationLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'action',
        'entity_type',
        'entity_id',
        'company_code',
        'sales_code',
        'status',
        'request_payload',
        'response_payload',
        'http_status_code',
        'error_message',
        'ip_address',
    ];

    public function scopeSuccessful($q) { return $q->where('status', 'success'); }
    public function scopeFailed($q) { return $q->where('status', 'failed'); }
}
