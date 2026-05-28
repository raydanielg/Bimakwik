<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceProvider extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'service_provider_type_id', 'provider_name', 'provider_code',
        'registration_number', 'phone', 'email', 'address', 'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function serviceProviderType()
    {
        return $this->belongsTo(ServiceProviderType::class, 'service_provider_type_id');
    }

    public function payments()
    {
        return $this->hasMany(ServiceProviderPayment::class, 'service_provider_id');
    }
}
