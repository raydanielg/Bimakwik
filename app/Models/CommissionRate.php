<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CommissionRate extends Model
{
    protected $fillable = [
        'insurer_id',
        'insurance_product_id',
        'policy_category_id',
        'channel_type',
        'rate_type',
        'rate_value',
        'min_premium_amount',
        'max_premium_amount',
        'effective_from',
        'effective_to',
        'is_active',
        'created_by',
    ];

    protected $casts = [
        'rate_value' => 'decimal:4',
        'is_active' => 'boolean',
        'effective_from' => 'date',
        'effective_to' => 'date',
    ];

    public function insurer(): BelongsTo
    {
        return $this->belongsTo(Insurer::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(InsuranceProduct::class, 'insurance_product_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(PolicyCategory::class, 'policy_category_id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public static function resolveRate($productId, $categoryId, $insurerId, $channelType, $premiumAmount)
    {
        return static::where('is_active', true)
            ->where(function ($q) use ($channelType) {
                $q->where('channel_type', $channelType)
                  ->orWhere('channel_type', 'direct');
            })
            ->where(function ($q) use ($productId) {
                $q->where('insurance_product_id', $productId)
                  ->orWhereNull('insurance_product_id');
            })
            ->where(function ($q) use ($categoryId) {
                $q->where('policy_category_id', $categoryId)
                  ->orWhereNull('policy_category_id');
            })
            ->where(function ($q) use ($insurerId) {
                $q->where('insurer_id', $insurerId)
                  ->orWhereNull('insurer_id');
            })
            ->where(function ($q) use ($premiumAmount) {
                $q->whereNull('min_premium_amount')
                  ->orWhere('min_premium_amount', '<=', $premiumAmount);
            })
            ->where(function ($q) use ($premiumAmount) {
                $q->whereNull('max_premium_amount')
                  ->orWhere('max_premium_amount', '>=', $premiumAmount);
            })
            ->where(function ($q) {
                $q->whereNull('effective_from')
                  ->orWhere('effective_from', '<=', now()->format('Y-m-d'));
            })
            ->where(function ($q) {
                $q->whereNull('effective_to')
                  ->orWhere('effective_to', '>=', now()->format('Y-m-d'));
            })
            ->orderByRaw('insurance_product_id IS NOT NULL DESC, policy_category_id IS NOT NULL DESC, insurer_id IS NOT NULL DESC')
            ->first();
    }
}
