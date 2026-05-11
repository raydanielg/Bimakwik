<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Role;
use App\Models\Module;
use App\Models\Permission;
use App\Models\UserModuleAccess;
use App\Models\CustomerProfile;
use App\Models\KycSubmission;
use App\Models\SupportTicket;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'national_id',
        'account_status',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The roles that belong to the user.
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function moduleAccess()
    {
        return $this->hasMany(UserModuleAccess::class, 'user_id');
    }

    /**
     * Check if user has a specific role.
     */
    public function hasRole($roleName)
    {
        return $this->roles->where('name', $roleName)->count() > 0;
    }

    public function isSuperAdmin()
    {
        return $this->hasRole('super_admin');
    }

    public function hasModulePermission($moduleCode, $action = 'view')
    {
        if ($this->isSuperAdmin()) {
            return true;
        }

        $module = Module::where('module_code', $moduleCode)->first();
        if (!$module) {
            return false;
        }

        // 1) Direct per-user override (highest priority)
        $direct = $this->moduleAccess()
            ->where('module_id', $module->id)
            ->where(function ($q) use ($action) {
                $q->where('access_level', 'full')
                    ->orWhere('access_level', $action);
            })
            ->where(function ($q) {
                $q->whereNull('expires_at')->orWhere('expires_at', '>', now());
            })
            ->exists();

        if ($direct) {
            return true;
        }

        // 2) Role permissions via role_permissions table (supports constraints)
        $permission = Permission::where('module_id', $module->id)
            ->where('permission_code', $action)
            ->first();

        if (!$permission) {
            return false;
        }

        $roleIds = $this->roles()->pluck('roles.id');

        return \App\Models\RolePermission::query()
            ->whereIn('role_id', $roleIds)
            ->where('permission_id', $permission->id)
            ->where('is_allowed', true)
            ->where(function ($q) {
                $q->whereNull('expires_at')->orWhere('expires_at', '>', now());
            })
            ->exists();
    }

    public function getModuleRestrictions($moduleCode)
    {
        if ($this->isSuperAdmin()) {
            return null;
        }

        $module = Module::where('module_code', $moduleCode)->first();
        if (!$module) {
            return null;
        }

        // Direct user restrictions
        $direct = $this->moduleAccess()
            ->where('module_id', $module->id)
            ->whereNotNull('restrictions')
            ->where(function ($q) {
                $q->whereNull('expires_at')->orWhere('expires_at', '>', now());
            })
            ->orderByDesc('id')
            ->first();

        if ($direct && is_array($direct->restrictions)) {
            return $direct->restrictions;
        }

        $permission = Permission::where('module_id', $module->id)
            ->where('permission_code', 'view')
            ->first();

        if (!$permission) {
            return null;
        }

        $roleIds = $this->roles()->pluck('roles.id');

        $constraints = \App\Models\RolePermission::query()
            ->whereIn('role_id', $roleIds)
            ->where('permission_id', $permission->id)
            ->where('is_allowed', true)
            ->whereNotNull('constraints')
            ->where(function ($q) {
                $q->whereNull('expires_at')->orWhere('expires_at', '>', now());
            })
            ->pluck('constraints')
            ->filter()
            ->toArray();

        if (!$constraints) {
            return null;
        }

        // Merge constraints (later items can override earlier keys)
        $merged = [];
        foreach ($constraints as $c) {
            if (is_array($c)) {
                $merged = array_merge($merged, $c);
            }
        }

        return $merged ?: null;
    }

    /**
     * The customer profile that belongs to the user.
     */
    public function profile()
    {
        return $this->hasOne(CustomerProfile::class);
    }

    /**
     * The kyc submissions that belong to the user.
     */
    public function kycSubmissions()
    {
        return $this->hasMany(KycSubmission::class);
    }

    /**
     * The support tickets that belong to the user.
     */
    public function supportTickets()
    {
        return $this->hasMany(SupportTicket::class);
    }
}
