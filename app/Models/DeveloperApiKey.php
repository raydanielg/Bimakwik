<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeveloperApiKey extends Model
{
    use HasFactory;

    protected $fillable = [
        'developer_app_id', 'api_key', 'api_secret_hash', 'key_name',
        'permissions', 'allowed_ips', 'rate_limit_per_minute',
        'expires_at', 'last_used_at', 'is_active',
    ];

    protected $casts = [
        'permissions' => 'array',
        'allowed_ips' => 'array',
        'expires_at' => 'datetime',
        'last_used_at' => 'datetime',
    ];

    public function developerApp()
    {
        return $this->belongsTo(DeveloperApp::class, 'developer_app_id');
    }
}
