<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceProvider extends Model
{
    use HasFactory;

    public function serviceProviderType()
    {
        return $this->belongsTo(ServiceProviderType::class, 'service_provider_type_id');
    }
}
