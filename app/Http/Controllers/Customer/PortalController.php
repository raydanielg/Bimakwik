<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class PortalController extends Controller
{
    public function dashboard()
    {
        return view('customer.dashboard', $this->buildViewData());
    }

    public function profile()
    {
        return view('customer.profile', $this->buildViewData());
    }

    public function support()
    {
        return view('customer.support', $this->buildViewData());
    }

    public function aiRecommendations()
    {
        return view('customer.ai-recommendations', $this->buildViewData());
    }

    public function marketplace()
    {
        return view('customer.marketplace', $this->buildViewData());
    }

    public function compare()
    {
        return view('customer.compare', $this->buildViewData());
    }

    public function buy()
    {
        return view('customer.buy', $this->buildViewData());
    }

    public function quote()
    {
        return view('customer.quote', $this->buildViewData());
    }

    public function policies()
    {
        return view('customer.policies.index', $this->buildViewData());
    }

    public function renewals()
    {
        return view('customer.policies.renewals', $this->buildViewData());
    }

    public function documents()
    {
        return view('customer.policies.documents', $this->buildViewData());
    }

    public function claimsCreate()
    {
        return view('customer.claims.create', $this->buildViewData());
    }

    public function claimsTrack()
    {
        return view('customer.claims.track', $this->buildViewData());
    }

    public function wallet()
    {
        return view('customer.wallet.index', $this->buildViewData());
    }

    public function walletAddFunds()
    {
        return view('customer.wallet.add-funds', $this->buildViewData());
    }

    public function walletHistory()
    {
        return view('customer.wallet.history', $this->buildViewData());
    }

    private function buildViewData(): array
    {
        $user = Auth::user();
        $userId = $user ? $user->id : null;
        $customerId = $this->resolveCustomerId($userId);
        $walletId = $this->resolveWalletId($userId, $customerId);

        $policies = $this->fetchRows('customer_policies', [
            'customer_id' => $customerId,
            'user_id' => $userId,
        ]);

        $claims = $this->fetchRows('claims', [
            'customer_id' => $customerId,
            'user_id' => $userId,
        ]);

        $renewals = $this->fetchRows('policy_renewals', [
            'customer_id' => $customerId,
            'user_id' => $userId,
        ]);

        $documents = $this->fetchRows('policy_documents', [
            'customer_id' => $customerId,
            'user_id' => $userId,
        ]);

        $walletTransactions = $this->fetchRows('wallet_transactions', [
            'wallet_id' => $walletId,
            'customer_id' => $customerId,
            'user_id' => $userId,
        ]);

        $products = $this->fetchRows('insurance_products', [], [
            'is_active' => true,
        ]);

        $recommendations = $this->fetchRows('ai_product_recommendations', [
            'customer_id' => $customerId,
            'user_id' => $userId,
        ]);

        return [
            'customerUser' => $user,
            'customerId' => $customerId,
            'walletId' => $walletId,
            'customerPolicies' => $policies,
            'customerClaims' => $claims,
            'customerRenewals' => $renewals,
            'customerDocuments' => $documents,
            'walletTransactions' => $walletTransactions,
            'marketProducts' => $products,
            'aiRecommendations' => $recommendations,
            'customerStats' => [
                'policies' => count($policies),
                'claims' => count($claims),
                'renewals' => count($renewals),
                'documents' => count($documents),
                'transactions' => count($walletTransactions),
                'products' => count($products),
                'recommendations' => count($recommendations),
            ],
        ];
    }

    private function resolveCustomerId($userId)
    {
        if (!$userId || !$this->tableExists('customers') || !$this->columnExists('customers', 'user_id')) {
            return null;
        }

        return optional(DB::table('customers')->where('user_id', $userId)->select('id')->first())->id;
    }

    private function resolveWalletId($userId, $customerId)
    {
        if (!$this->tableExists('wallets')) {
            return null;
        }

        $query = DB::table('wallets');

        if ($customerId && $this->columnExists('wallets', 'customer_id')) {
            $query->where('customer_id', $customerId);
        } elseif ($userId && $this->columnExists('wallets', 'user_id')) {
            $query->where('user_id', $userId);
        } else {
            return null;
        }

        return optional($query->select('id')->first())->id;
    }

    private function fetchRows(string $table, array $identityFilters = [], array $genericFilters = [], int $limit = 15): array
    {
        if (!$this->tableExists($table)) {
            return [];
        }

        $query = DB::table($table);

        $identityApplied = false;
        foreach ($identityFilters as $column => $value) {
            if ($value !== null && $this->columnExists($table, $column)) {
                $query->where($column, $value);
                $identityApplied = true;
                break;
            }
        }

        foreach ($genericFilters as $column => $value) {
            if ($this->columnExists($table, $column)) {
                $query->where($column, $value);
            }
        }

        if (!$identityApplied && !empty($identityFilters)) {
            return [];
        }

        if ($this->columnExists($table, 'updated_at')) {
            $query->orderByDesc('updated_at');
        } elseif ($this->columnExists($table, 'created_at')) {
            $query->orderByDesc('created_at');
        } elseif ($this->columnExists($table, 'id')) {
            $query->orderByDesc('id');
        }

        return $query->limit($limit)->get()->map(static function ($row) {
            return (array) $row;
        })->all();
    }

    private function tableExists(string $table): bool
    {
        try {
            return Schema::hasTable($table);
        } catch (\Throwable $e) {
            return false;
        }
    }

    private function columnExists(string $table, string $column): bool
    {
        try {
            return Schema::hasColumn($table, $column);
        } catch (\Throwable $e) {
            return false;
        }
    }
}
