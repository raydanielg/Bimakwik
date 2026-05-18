<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsuranceProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'policy_category_id',
        'insurer_id',
        'premium',
        'min_age',
        'max_age',
        'benefits',
        'exclusions',
        'is_active',
    ];

    protected $casts = [
        'benefits' => 'array',
        'exclusions' => 'array',
        'is_active' => 'boolean',
    ];

    public function policyCategory()
    {
        return $this->belongsTo(PolicyCategory::class);
    }

    public function insurer()
    {
        return $this->belongsTo(User::class, 'insurer_id');
    }

    public function productBenefits()
    {
        return $this->hasMany(ProductBenefit::class);
    }

    public function productExclusions()
    {
        return $this->hasMany(ProductExclusion::class);
    }
}
