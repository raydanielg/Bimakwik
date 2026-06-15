<?php

namespace App\Services;

use App\Models\CommissionRate;
use App\Models\CommissionTransaction;
use App\Models\CustomerPolicy;

class CommissionService
{
    public function calculateAndCreate(CustomerPolicy $policy): array
    {
        $transactions = [];
        $productId = $policy->insurance_product_id;
        $categoryId = $policy->product?->policy_category_id;
        $insurerId = $policy->insurer_id;
        $premium = $policy->premium_amount;

        $channels = $this->resolveChannels($policy);

        foreach ($channels as $channel) {
            $rate = CommissionRate::resolveRate(
                $productId, $categoryId, $insurerId,
                $channel['type'], $premium
            );

            if (!$rate) continue;

            $amount = $rate->rate_type === 'percentage'
                ? $premium * ($rate->rate_value / 100)
                : min($rate->rate_value, $premium);

            $txn = CommissionTransaction::create([
                'customer_policy_id' => $policy->id,
                'commission_rate_id' => $rate->id,
                'channel_type' => $channel['type'],
                'recipient_type' => $channel['recipient_type'],
                'recipient_id' => $channel['recipient_id'],
                'premium_amount' => $premium,
                'rate_value' => $rate->rate_value,
                'rate_type' => $rate->rate_type,
                'commission_amount' => $amount,
                'status' => 'pending',
            ]);

            $transactions[] = $txn;
        }

        return $transactions;
    }

    public function calculateTotal(CustomerPolicy $policy): float
    {
        $productId = $policy->insurance_product_id;
        $categoryId = $policy->product?->policy_category_id;
        $insurerId = $policy->insurer_id;
        $premium = $policy->premium_amount;
        $total = 0;

        $channels = $this->resolveChannels($policy);
        foreach ($channels as $channel) {
            $rate = CommissionRate::resolveRate(
                $productId, $categoryId, $insurerId,
                $channel['type'], $premium
            );
            if (!$rate) continue;

            $total += $rate->rate_type === 'percentage'
                ? $premium * ($rate->rate_value / 100)
                : min($rate->rate_value, $premium);
        }

        return $total;
    }

    private function resolveChannels(CustomerPolicy $policy): array
    {
        $channels = [];

        if ($policy->agent_id) {
            $agentType = $policy->agent?->agent_type;

            $recipientType = match ($agentType) {
                'sfe' => 'sfe_user',
                'bancassurance' => 'bancassurance_user',
                default => 'agent',
            };

            $channelType = match ($agentType) {
                'sfe' => 'sfe',
                'bancassurance' => 'bancassurance',
                default => 'agent',
            };

            $channels[] = [
                'type' => $channelType,
                'recipient_type' => $recipientType,
                'recipient_id' => $policy->agent_id,
            ];
        }

        if ($policy->broker_id) {
            $channels[] = [
                'type' => 'broker',
                'recipient_type' => 'broker',
                'recipient_id' => $policy->broker_id,
            ];
        }

        return $channels;
    }
}
