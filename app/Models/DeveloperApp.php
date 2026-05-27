<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeveloperApp extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'app_name', 'app_description', 'app_logo_url',
        'app_website', 'redirect_uris', 'is_active',
    ];

    protected $casts = ['redirect_uris' => 'array'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function apiKeys()
    {
        return $this->hasMany(DeveloperApiKey::class, 'developer_app_id');
    }
}
