<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insurer extends Model
{
    use HasFactory;

    protected $fillable = [
        'insurer_code', 'company_code', 'sales_code', 'insurer_name',
        'registration_number', 'license_number', 'tin', 'address', 'city',
        'phone', 'email', 'website', 'logo_url', 'is_active',
        'tiramis_api_key', 'tiramis_enabled', 'tiramis_last_sync_at',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'tiramis_enabled' => 'boolean',
        'tiramis_last_sync_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->hasMany(InsuranceProduct::class);
    }

    public function branches()
    {
        return $this->hasMany(InsurerBranch::class);
    }
}
