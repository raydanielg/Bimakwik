<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceProviderPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_provider_id', 'claim_id', 'amount', 'payment_date',
        'payment_reference', 'status', 'processed_by',
    ];

    protected $casts = ['payment_date' => 'date'];

    public function serviceProvider()
    {
        return $this->belongsTo(ServiceProvider::class, 'service_provider_id');
    }

    public function claim()
    {
        return $this->belongsTo(Claim::class);
    }
}
