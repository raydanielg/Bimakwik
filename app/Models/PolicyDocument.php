<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PolicyDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'policy_id',
        'document_type',
        'file_path',
        'file_name',
        'status',
    ];

    public function policy(): BelongsTo
    {
        return $this->belongsTo(CustomerPolicy::class, 'policy_id');
    }
}
