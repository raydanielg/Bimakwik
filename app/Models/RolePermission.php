<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Role;
use App\Models\Permission;
use App\Models\User;

class RolePermission extends Model
{
    use HasFactory;

    protected $fillable = [
        'role_id',
        'permission_id',
        'is_allowed',
        'constraints',
        'granted_by',
        'granted_at',
        'expires_at',
    ];

    protected $casts = [
        'constraints' => 'array',
        'granted_at' => 'datetime',
        'expires_at' => 'datetime',
        'is_allowed' => 'boolean',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function permission()
    {
        return $this->belongsTo(Permission::class);
    }

    public function granter()
    {
        return $this->belongsTo(User::class, 'granted_by');
    }
}
