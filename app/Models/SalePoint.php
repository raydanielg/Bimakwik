<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SalePoint extends Model
{
    protected $fillable = [
        'sale_point_code',
        'name',
        'company_code',
        'entity_type',
        'entity_id',
        'location',
        'contact_person',
        'contact_phone',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function entity(): BelongsTo
    {
        return $this->morphTo();
    }
}
