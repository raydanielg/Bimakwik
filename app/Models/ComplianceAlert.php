<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplianceAlert extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'severity',
        'title',
        'description',
        'entity_type',
        'entity_id',
        'status',
        'resolved_at',
    ];

    protected $dates = [
        'resolved_at',
    ];
}
