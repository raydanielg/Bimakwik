<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModuleAccess extends Model
{
    use HasFactory;

    protected $table = 'user_module_access';

    protected $fillable = [
        'user_id',
        'module_id',
        'permission_id',
        'access_level',
        'restrictions',
        'granted_by',
        'granted_at',
        'expires_at',
    ];

    protected $casts = [
        'restrictions' => 'array',
        'granted_at' => 'datetime',
        'expires_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function permission()
    {
        return $this->belongsTo(Permission::class);
    }
}
