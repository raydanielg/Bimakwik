<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'agent_number', 'agent_type', 'first_name', 'last_name',
        'phone', 'email', 'tin', 'company_code', 'sales_code', 'address',
        'city', 'profile_photo_url', 'broker_id', 'insurer_id',
        'commission_rate', 'status', 'approved_by', 'approved_at',
        'tiramis_enabled',
    ];

    protected $casts = [
        'approved_at' => 'datetime',
        'commission_rate' => 'decimal:2',
        'tiramis_enabled' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function broker()
    {
        return $this->belongsTo(Broker::class);
    }

    public function insurer()
    {
        return $this->belongsTo(Insurer::class);
    }
}
