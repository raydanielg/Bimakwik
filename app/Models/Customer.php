<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'customer_number',
        'date_of_birth',
        'gender',
        'nationality',
        'residential_address',
        'city',
        'district',
        'region',
        'occupation',
        'employer_name',
        'emergency_contact_name',
        'emergency_contact_phone',
        'profile_photo_url',
        'kyc_status',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function policies()
    {
        return $this->hasMany(CustomerPolicy::class);
    }

    public function claims()
    {
        return $this->hasMany(Claim::class);
    }

    public function wallet()
    {
        return $this->hasOneThrough(Wallet::class, User::class, 'id', 'user_id', 'user_id', 'id');
    }

    public function getNameAttribute()
    {
        return $this->user->name ?? 'Unknown';
    }

    public function getFullNameAttribute()
    {
        return $this->user->name ?? 'Unknown';
    }
}
