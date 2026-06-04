<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'report_name',
        'report_type',
        'report_query',
        'parameters',
        'columns',
        'filters',
        'is_system',
        'is_active',
        'created_by',
    ];

    protected $casts = [
        'parameters' => 'array',
        'columns' => 'array',
        'filters' => 'array',
        'is_system' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
