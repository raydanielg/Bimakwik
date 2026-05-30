<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\CustomerPolicy;
use App\Models\Wallet;
use App\Models\WalletTransaction;

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

    public function buySubmit(Request $request)
    {
        $validated = $request->validate([
            'product' => 'required|string',
            'coverage' => 'required|string',
            'period' => 'required|string',
            'price' => 'required|numeric',
        ]);

        try {
            // Get customer_id from customers table using user_id
            $customerId = DB::table('customers')->where('user_id', auth()->id())->value('id');
            
            // Auto-create customer record if not exists
            if (!$customerId) {
                $customerId = DB::table('customers')->insertGetId([
                    'user_id' => auth()->id(),
                    'customer_number' => 'CUST-' . strtoupper(substr(uniqid(), -8)),
                    'nationality' => 'Tanzanian',
                    'kyc_status' => 'pending',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // Get or create default insurer
            $insurerId = DB::table('insurers')->value('id');
            if (!$insurerId) {
                $insurerId = DB::table('insurers')->insertGetId([
                    'insurer_name' => 'Default Insurer',
                    'insurer_code' => 'DEF001',
                    'email' => 'default@insurer.com',
                    'phone' => '+255000000000',
                    'address' => 'Default Address',
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
            
            // Get or create insurance product
            $productId = DB::table('insurance_products')
                ->where('name', 'like', '%' . $validated['product'] . '%')
                ->value('id');
            
            if (!$productId) {
                $productId = DB::table('insurance_products')->insertGetId([
                    'name' => ucfirst($validated['product']) . ' Insurance',
                    'code' => strtoupper(substr($validated['product'], 0, 3)) . '001',
                    'category' => $validated['product'],
                    'description' => ucfirst($validated['product']) . ' insurance coverage',
                    'premium' => $validated['price'],
                    'status' => 'active',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // Create new policy
            $policy = CustomerPolicy::create([
                'customer_id' => $customerId,
                'insurance_product_id' => $productId,
                'insurer_id' => $insurerId,
                'policy_number' => 'POL-' . strtoupper(substr(uniqid(), -8)),
                'premium_amount' => $validated['price'],
                'premium_frequency' => $validated['period'],
                'sum_assured' => $this->getCoverageAmount($validated['coverage']),
                'start_date' => now(),
                'end_date' => now()->addMonths($this->getMonthsFromPeriod($validated['period'])),
                'status' => 'active',
                'payment_method' => 'wallet',
                'policy_details' => [
                    'coverage_level' => $validated['coverage'],
                    'product_type' => $validated['product'],
                ],
            ]);

            // Deduct from wallet if balance exists
            $wallet = Wallet::where('user_id', auth()->id())->first();
            if ($wallet && $wallet->balance >= $validated['price']) {
                $wallet->balance -= $validated['price'];
                $wallet->save();

                WalletTransaction::create([
                    'wallet_id' => $wallet->id,
                    'type' => 'debit',
                    'amount' => $validated['price'],
                    'description' => 'Policy purchase: ' . $validated['product'] . ' insurance',
                    'status' => 'completed',
                    'reference' => 'POL-' . $policy->policy_number,
                ]);
            }

            return redirect()->route('customer.policies.index')->with('success', 'Policy purchased successfully! Policy Number: ' . $policy->policy_number);
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to purchase policy: ' . $e->getMessage());
        }
    }

    private function getMonthsFromPeriod($period)
    {
        $periods = [
            'monthly' => 1,
            'quarterly' => 3,
            'semi_annual' => 6,
            'annual' => 12,
        ];
        return $periods[$period] ?? 12;
    }

    private function getCoverageAmount($coverage)
    {
        $coverages = [
            'basic' => 500000,
            'standard' => 1000000,
            'premium' => 2000000,
            'elite' => 5000000,
        ];
        return $coverages[$coverage] ?? 500000;
    }

    public function quote()
    {
        return view('customer.quote', $this->buildViewData());
    }

    public function quoteSubmit(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:insurance_products,id',
            'coverage_amount' => 'required|numeric',
            'duration' => 'required|integer',
        ]);

        try {
            // Calculate quote based on product and coverage
            $product = DB::table('insurance_products')->where('id', $validated['product_id'])->first();
            $quoteAmount = $product ? ($product->premium * $validated['coverage_amount'] / 100000) : 0;
            
            return back()->with('success', 'Quote generated: TZS ' . number_format($quoteAmount, 0))->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to generate quote');
        }
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
