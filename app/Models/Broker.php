<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Broker extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'broker_number', 'company_name', 'license_number',
        'company_code', 'sales_code', 'tin', 'address', 'city', 'phone',
        'email', 'website', 'logo_url', 'commission_rate', 'status',
        'approved_by', 'approved_at', 'tiramis_enabled',
    ];

    protected $casts = [
        'approved_at' => 'datetime',
        'tiramis_enabled' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function agents()
    {
        return $this->hasMany(Agent::class);
    }
}
