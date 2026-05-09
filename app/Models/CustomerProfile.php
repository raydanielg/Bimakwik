<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date_of_birth',
        'gender',
        'nationality',
        'residential_address',
        'postal_address',
        'city',
        'ward',
        'district',
        'region',
        'occupation',
        'employer_name',
        'emergency_contact_name',
        'emergency_contact_phone',
        'profile_photo_url'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
