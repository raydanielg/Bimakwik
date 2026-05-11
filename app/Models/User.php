<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Role;

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

    /**
     * Check if user has a specific role.
     */
    public function hasRole($roleName)
    {
        return $this->roles->where('name', $roleName)->count() > 0;
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
