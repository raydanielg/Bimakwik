<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsuranceProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'policy_category_id',
        'insurer_id',
        'product_code',
        'product_name',
        'description',
        'base_premium',
        'currency',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'base_premium' => 'decimal:2',
    ];

    public function policyCategory()
    {
        return $this->belongsTo(PolicyCategory::class);
    }

    public function insurer()
    {
        return $this->belongsTo(Insurer::class, 'insurer_id');
    }

    public function customerPolicies()
    {
        return $this->hasMany(CustomerPolicy::class, 'insurance_product_id');
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
