<?php

namespace App\Support;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DashboardMetrics
{
    public function customer(User $user): array
    {
        $customerId = optional($user->customerProfile)->id;
        $base = $this->tableQuery('customer_policies', 'customer_id', $customerId);

        return [
            'active_policies' => $this->countFrom($base, 'status', 'active'),
            'claims' => $this->countTable('claims', 'customer_id', $customerId),
            'days_to_expiry' => $this->daysToNextPolicyExpiry($customerId),
            'premium_total' => $this->sumFrom($base, 'premium_amount'),
        ];
    }

    public function broker(User $user): array
    {
        $brokerId = optional($user->brokerProfile)->id;
        $policies = $this->tableQuery('customer_policies', 'broker_id', $brokerId);

        return [
            'premium_total' => $this->sumFrom($policies, 'premium_amount'),
            'commission_total' => $this->sumTable('broker_commissions', 'commission_amount', 'broker_id', $brokerId),
            'active_policies' => $this->countFrom($policies, 'status', 'active'),
            'pending_renewals' => $this->renewalCount('broker_id', $brokerId),
            'recent_sales' => $this->recentPolicies('broker_id', $brokerId),
        ];
    }

    public function aggregator(User $user): array
    {
        $aggregatorId = optional($user->aggregatorProfile)->id;
        $clicks = $this->countTable('aggregator_referral_clicks', 'aggregator_id', $aggregatorId);
        $sales = $this->countTable('aggregator_referral_sales', 'aggregator_id', $aggregatorId);

        return [
            'quotes' => $clicks,
            'leads_converted' => $sales,
            'referral_fees' => $this->sumTable('aggregator_commissions', 'commission_amount', 'aggregator_id', $aggregatorId),
            'ctr_rate' => $clicks > 0 ? round(($sales / $clicks) * 100, 1) : 0,
        ];
    }

    public function agent(User $user): array
    {
        $agentId = optional($user->agentProfile)->id;
        $policies = $this->tableQuery('customer_policies', 'agent_id', $agentId);

        return [
            'sales_total' => $this->sumFrom($policies, 'premium_amount'),
            'commission_total' => $this->sumTable('agent_commissions', 'commission_amount', 'agent_id', $agentId),
            'active_policies' => $this->countFrom($policies, 'status', 'active'),
            'customers' => $this->countTable('agent_customers', 'agent_id', $agentId),
        ];
    }

    public function insurer(User $user): array
    {
        $insurerId = optional($user->insurerProfile)->id;
        $policies = $this->tableQuery('customer_policies', 'insurer_id', $insurerId);

        return [
            'premium_total' => $this->sumFrom($policies, 'premium_amount'),
            'active_policies' => $this->countFrom($policies, 'status', 'active'),
            'pending_claims' => $this->countInsurerClaims($insurerId),
            'settlement_ratio' => $this->settlementRatio($insurerId),
        ];
    }

    public function serviceProvider(User $user): array
    {
        $providerId = optional($user->providerProfile)->id;

        return [
            'bills_submitted' => $this->countTable('claims', 'service_provider_id', $providerId),
            'approved_amount' => $this->sumTable('claims', 'approved_amount', 'service_provider_id', $providerId),
            'paid_amount' => $this->sumTable('service_provider_payments', 'amount', 'service_provider_id', $providerId),
            'processing_days' => 0,
        ];
    }

    public function developer(User $user): array
    {
        $developerId = $user->id;

        return [
            'api_requests' => $this->sumTable('api_usage_statistics', 'request_count', 'developer_id', $developerId),
            'active_keys' => $this->countTable('developer_api_keys', 'user_id', $developerId),
            'apps' => $this->countTable('developer_apps', 'user_id', $developerId),
            'avg_latency' => $this->averageTable('api_usage_statistics', 'average_response_time', 'developer_id', $developerId),
        ];
    }

    public function financingPartner(User $user): array
    {
        $partnerId = optional($user->financingPartnerProfile ?? null)->id;

        return [
            'active_loans' => $this->countTable('financing_loans', 'status', 'active'),
            'disbursed' => $this->sumTable('financing_disbursements', 'amount', 'financing_partner_id', $partnerId),
            'pending_approvals' => $this->countTable('premium_financing_requests', 'status', 'pending'),
            'outstanding' => $this->sumTable('financing_loans', 'outstanding_balance', 'financing_partner_id', $partnerId),
        ];
    }

    public function money($value): string
    {
        return 'TZS ' . number_format((float) $value, 0);
    }

    private function tableQuery(string $table, ?string $column = null, $value = null): ?Builder
    {
        if (!Schema::hasTable($table)) {
            return null;
        }

        $query = DB::table($table);

        if ($column && $value && Schema::hasColumn($table, $column)) {
            $query->where($column, $value);
        } elseif ($column && !$value) {
            return null;
        }

        return $query;
    }

    private function countTable(string $table, ?string $column = null, $value = null): int
    {
        return $this->countFrom($this->tableQuery($table, $column, $value));
    }

    private function countFrom(?Builder $query, ?string $column = null, $value = null): int
    {
        if (!$query) {
            return 0;
        }

        $query = clone $query;

        if ($column && Schema::hasColumn($query->from, $column)) {
            $query->where($column, $value);
        }

        return (int) $query->count();
    }

    private function sumTable(string $table, string $sumColumn, ?string $whereColumn = null, $value = null): float
    {
        return $this->sumFrom($this->tableQuery($table, $whereColumn, $value), $sumColumn);
    }

    private function sumFrom(?Builder $query, string $column): float
    {
        if (!$query || !Schema::hasColumn($query->from, $column)) {
            return 0;
        }

        $query = clone $query;

        return (float) $query->sum($column);
    }

    private function averageTable(string $table, string $avgColumn, ?string $whereColumn = null, $value = null): float
    {
        $query = $this->tableQuery($table, $whereColumn, $value);
        if (!$query || !Schema::hasColumn($table, $avgColumn)) {
            return 0;
        }

        $query = clone $query;

        return (float) $query->avg($avgColumn);
    }

    private function daysToNextPolicyExpiry($customerId): int
    {
        $query = $this->tableQuery('customer_policies', 'customer_id', $customerId);
        if (!$query || !Schema::hasColumn('customer_policies', 'end_date')) {
            return 0;
        }

        $endDate = $query->where('end_date', '>=', now()->toDateString())->min('end_date');

        return $endDate ? max(0, now()->startOfDay()->diffInDays(Carbon::parse($endDate), false)) : 0;
    }

    private function renewalCount(string $ownerColumn, $ownerId): int
    {
        $query = $this->tableQuery('customer_policies', $ownerColumn, $ownerId);
        if (!$query || !Schema::hasColumn('customer_policies', 'end_date')) {
            return 0;
        }

        return (int) $query
            ->whereBetween('end_date', [now()->toDateString(), now()->addDays(30)->toDateString()])
            ->count();
    }

    private function recentPolicies(string $ownerColumn, $ownerId): array
    {
        $query = $this->tableQuery('customer_policies', $ownerColumn, $ownerId);
        if (!$query) {
            return [];
        }

        return (clone $query)
            ->orderByDesc('created_at')
            ->limit(5)
            ->get()
            ->map(fn ($policy) => (array) $policy)
            ->all();
    }

    private function countInsurerClaims($insurerId): int
    {
        if (!$insurerId || !Schema::hasTable('claims') || !Schema::hasTable('customer_policies')) {
            return 0;
        }

        return (int) DB::table('claims')
            ->join('customer_policies', 'claims.customer_policy_id', '=', 'customer_policies.id')
            ->where('customer_policies.insurer_id', $insurerId)
            ->whereNotIn('claims.status', ['approved', 'rejected', 'settled', 'closed'])
            ->count();
    }

    private function settlementRatio($insurerId): float
    {
        if (!$insurerId || !Schema::hasTable('claims') || !Schema::hasTable('customer_policies')) {
            return 0;
        }

        $total = DB::table('claims')
            ->join('customer_policies', 'claims.customer_policy_id', '=', 'customer_policies.id')
            ->where('customer_policies.insurer_id', $insurerId)
            ->count();

        if (!$total) {
            return 0;
        }

        $settled = DB::table('claims')
            ->join('customer_policies', 'claims.customer_policy_id', '=', 'customer_policies.id')
            ->where('customer_policies.insurer_id', $insurerId)
            ->whereIn('claims.status', ['approved', 'settled', 'closed'])
            ->count();

        return round(($settled / $total) * 100, 1);
    }
}
