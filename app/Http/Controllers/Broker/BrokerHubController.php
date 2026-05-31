<?php

namespace App\Http\Controllers\Broker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerPolicy;
use App\Models\User;
use App\Models\BrokerCommission;
use App\Models\BrokerCommissionWithdrawal;
use App\Models\Claim;
use App\Models\ClaimFraudAlert;
use App\Models\InsuranceProduct;
use App\Models\PolicyRenewal;
use App\Models\PolicyEndorsement;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use App\Models\KycSubmission;
use App\Models\Broker;
use App\Models\ApiKey;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BrokerHubController extends Controller
{
    private function getBroker()
    {
        return Broker::where('user_id', Auth::id())->first();
    }

    // ─── Core Pages ───────────────────────────────────────────────────────────

    public function policies()
    {
        $policies = collect(); $totalCount = 0; $activeCount = 0; $expiredCount = 0;
        try {
            $policies = CustomerPolicy::with(['customer', 'insuranceProduct'])->latest()->paginate(15);
            $totalCount = CustomerPolicy::count();
            $activeCount = CustomerPolicy::where('status', 'active')->count();
            $expiredCount = CustomerPolicy::where('status', 'expired')->count();
        } catch (\Exception $e) {}
        return view('broker.policies.index', compact('policies', 'totalCount', 'activeCount', 'expiredCount'));
    }

    public function customers()
    {
        $customers = collect();
        try { $customers = User::role('customer')->with('customerProfile')->paginate(15); } catch (\Exception $e) {}
        return view('broker.customers.index', compact('customers'));
    }

    public function commissions()
    {
        $commissions = collect(); $totalEarned = 0; $pendingAmount = 0;
        try {
            $commissions = BrokerCommission::with(['customerPolicy.insuranceProduct'])->latest()->paginate(15);
            $totalEarned = BrokerCommission::where('status', 'paid')->sum('commission_amount') ?? 0;
            $pendingAmount = BrokerCommission::where('status', 'pending')->sum('commission_amount') ?? 0;
        } catch (\Exception $e) {}
        return view('broker.commissions.index', compact('commissions', 'totalEarned', 'pendingAmount'));
    }

    public function reports()
    {
        $totalPolicies = 0; $totalClaims = 0; $totalCommission = 0; $monthlyData = [];
        try {
            $totalPolicies = CustomerPolicy::count();
            $totalClaims = Claim::count();
            $totalCommission = BrokerCommission::sum('commission_amount');
            $monthlyData = BrokerCommission::selectRaw("strftime('%Y-%m', created_at) as month, SUM(commission_amount) as total")
                ->where('created_at', '>=', Carbon::now()->subMonths(6))
                ->groupBy('month')
                ->orderBy('month')
                ->get();
        } catch (\Exception $e) {}
        return view('broker.reports.index', compact('totalPolicies', 'totalClaims', 'totalCommission', 'monthlyData'));
    }

    public function products()
    {
        $products = collect();
        try { $products = InsuranceProduct::where('status', 'active')->latest()->paginate(15); } catch (\Exception $e) {}
        return view('broker.products.index', compact('products'));
    }

    public function claims()
    {
        $claims = collect(); $pendingCount = 0; $approvedCount = 0;
        try {
            $claims = Claim::with(['customer'])->latest()->paginate(15);
            $pendingCount = Claim::where('status', 'pending')->count();
            $approvedCount = Claim::where('status', 'approved')->count();
        } catch (\Exception $e) {}
        return view('broker.claims.index', compact('claims', 'pendingCount', 'approvedCount'));
    }

    // ─── Core Dashboard Extras ────────────────────────────────────────────────

    public function transactions()
    {
        $transactions = collect(); $totalIn = 0; $totalOut = 0;
        try {
            $broker = $this->getBroker();
            if ($broker) {
                $wallet = Wallet::where('user_id', Auth::id())->first();
                if ($wallet) {
                    $transactions = WalletTransaction::where('wallet_id', $wallet->id)->latest()->paginate(20);
                    $totalIn = WalletTransaction::where('wallet_id', $wallet->id)->where('type', 'credit')->sum('amount');
                    $totalOut = WalletTransaction::where('wallet_id', $wallet->id)->where('type', 'debit')->sum('amount');
                }
            }
        } catch (\Exception $e) {}
        return view('broker.transactions.index', compact('transactions', 'totalIn', 'totalOut'));
    }

    public function aiInsights()
    {
        $topProducts = collect(); $monthlyCommissions = []; $labels = [];
        try {
            $topProducts = InsuranceProduct::withCount(['customerPolicies as policies_count'])->orderByDesc('policies_count')->take(5)->get();
            $commData = BrokerCommission::selectRaw("strftime('%Y-%m', created_at) as month, SUM(commission_amount) as total")
                ->where('created_at', '>=', Carbon::now()->subMonths(6))
                ->groupBy('month')
                ->orderBy('month')
                ->get();
            $labels = $commData->pluck('month')->toArray();
            $monthlyCommissions = $commData->pluck('total')->toArray();
        } catch (\Exception $e) {}
        return view('broker.ai-insights.index', compact('topProducts', 'monthlyCommissions', 'labels'));
    }

    // ─── Products ─────────────────────────────────────────────────────────────

    public function productCompare()
    {
        $products = collect();
        try { $products = InsuranceProduct::where('status', 'active')->with(['productBenefits', 'productCategory'])->get(); } catch (\Exception $e) {}
        return view('broker.products.compare', compact('products'));
    }

    public function productRecommendations()
    {
        $recommended = collect();
        try { $recommended = InsuranceProduct::where('status', 'active')->latest()->take(6)->get(); } catch (\Exception $e) {}
        return view('broker.products.recommendations', compact('recommended'));
    }

    // ─── Customers ────────────────────────────────────────────────────────────

    public function customersKyc()
    {
        $kycList = collect(); $verifiedCount = 0; $pendingCount = 0; $rejectedCount = 0;
        try {
            $kycList = KycSubmission::with('user')->latest()->paginate(15);
            $verifiedCount = KycSubmission::where('status', 'verified')->count();
            $pendingCount = KycSubmission::where('status', 'pending')->count();
            $rejectedCount = KycSubmission::where('status', 'rejected')->count();
        } catch (\Exception $e) {}
        return view('broker.customers.kyc', compact('kycList', 'verifiedCount', 'pendingCount', 'rejectedCount'));
    }

    // ─── Policies ─────────────────────────────────────────────────────────────

    public function policyRenewals()
    {
        $renewals = collect(); $pendingCount = 0; $overdueCount = 0;
        try {
            $renewals = PolicyRenewal::with(['customerPolicy.customer', 'customerPolicy.insuranceProduct'])->latest()->paginate(15);
            $pendingCount = PolicyRenewal::where('status', 'pending')->count();
            $overdueCount = PolicyRenewal::where('renewal_date', '<', now())->where('status', 'pending')->count();
        } catch (\Exception $e) {}
        return view('broker.policies.renewals', compact('renewals', 'pendingCount', 'overdueCount'));
    }

    public function policyEndorsements()
    {
        $endorsements = collect();
        try {
            $endorsements = PolicyEndorsement::with(['customerPolicy.customer'])->latest()->paginate(15);
        } catch (\Exception $e) {}
        return view('broker.policies.endorsements', compact('endorsements'));
    }

    public function policyExpiry()
    {
        $expiring = collect(); $expiredCount = 0;
        try {
            $expiring = CustomerPolicy::with(['customer', 'insuranceProduct'])
                ->where('expiry_date', '<=', Carbon::now()->addDays(30))
                ->where('status', 'active')
                ->orderBy('expiry_date')
                ->paginate(15);
            $expiredCount = CustomerPolicy::where('status', 'expired')->count();
        } catch (\Exception $e) {}
        return view('broker.policies.expiry', compact('expiring', 'expiredCount'));
    }

    // ─── Wallet ───────────────────────────────────────────────────────────────

    public function wallet()
    {
        $wallet = null; $recentTransactions = collect(); $totalCommission = 0;
        try {
            $wallet = Wallet::where('user_id', Auth::id())->first();
            if ($wallet) {
                $recentTransactions = WalletTransaction::where('wallet_id', $wallet->id)->latest()->take(10)->get();
            }
            $totalCommission = BrokerCommission::where('status', 'paid')->sum('commission_amount');
        } catch (\Exception $e) {}
        return view('broker.wallet.index', compact('wallet', 'recentTransactions', 'totalCommission'));
    }

    public function walletCashout()
    {
        $wallet = null; $pendingWithdrawals = collect();
        try {
            $wallet = Wallet::where('user_id', Auth::id())->first();
            $pendingWithdrawals = BrokerCommissionWithdrawal::where('broker_id', optional($this->getBroker())->id)->latest()->paginate(10);
        } catch (\Exception $e) {}
        return view('broker.wallet.cashout', compact('wallet', 'pendingWithdrawals'));
    }

    public function walletCashoutSubmit(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1000',
            'bank_account' => 'required|string|max:100',
            'bank_name' => 'required|string|max:100',
        ]);
        try {
            $broker = $this->getBroker();
            if ($broker) {
                BrokerCommissionWithdrawal::create([
                    'broker_id' => $broker->id,
                    'amount' => $request->amount,
                    'bank_account' => $request->bank_account,
                    'bank_name' => $request->bank_name,
                    'status' => 'pending',
                ]);
                return redirect()->route('broker.wallet.cashout')->with('success', 'Withdrawal request submitted successfully.');
            }
        } catch (\Exception $e) {}
        return back()->with('error', 'Could not submit withdrawal request.');
    }

    // ─── Claims ───────────────────────────────────────────────────────────────

    public function claimsFraud()
    {
        $fraudAlerts = collect(); $highRiskCount = 0;
        try {
            $fraudAlerts = ClaimFraudAlert::with(['claim.customer'])->latest()->paginate(15);
            $highRiskCount = ClaimFraudAlert::where('risk_level', 'high')->count();
        } catch (\Exception $e) {}
        return view('broker.claims.fraud', compact('fraudAlerts', 'highRiskCount'));
    }

    // ─── Messaging ────────────────────────────────────────────────────────────

    public function messaging()
    {
        $notifications = collect(); $unreadCount = 0;
        try {
            $notifications = Notification::where('notifiable_id', Auth::id())
                ->where('notifiable_type', User::class)
                ->latest()
                ->paginate(20);
            $unreadCount = Notification::where('notifiable_id', Auth::id())
                ->whereNull('read_at')
                ->count();
        } catch (\Exception $e) {}
        return view('broker.messaging.index', compact('notifications', 'unreadCount'));
    }

    // ─── Compliance ───────────────────────────────────────────────────────────

    public function compliance()
    {
        $broker = null; $licenses = collect();
        try {
            $broker = $this->getBroker();
            if ($broker) {
                $licenses = \App\Models\BrokerLicense::where('broker_id', $broker->id)->get();
            }
        } catch (\Exception $e) {}
        return view('broker.compliance.index', compact('broker', 'licenses'));
    }

    // ─── Profile ──────────────────────────────────────────────────────────────

    public function profile()
    {
        $broker = null; $bankDetail = null;
        try {
            $broker = Broker::with(['brokerProfile', 'bankDetail'])->where('user_id', Auth::id())->first();
            $bankDetail = optional($broker)->bankDetail;
        } catch (\Exception $e) {}
        return view('broker.profile.index', compact('broker', 'bankDetail'));
    }

    public function profileUpdate(Request $request)
    {
        $request->validate([
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:191',
            'address' => 'nullable|string|max:500',
        ]);
        try {
            $broker = $this->getBroker();
            if ($broker) {
                $broker->update($request->only(['phone', 'email', 'address']));
                return back()->with('success', 'Profile updated successfully.');
            }
        } catch (\Exception $e) {}
        return back()->with('error', 'Could not update profile.');
    }

    // ─── API Keys ─────────────────────────────────────────────────────────────

    public function apiKeys()
    {
        $apiKeys = collect();
        try {
            $apiKeys = ApiKey::where('user_id', Auth::id())->latest()->get();
        } catch (\Exception $e) {}
        return view('broker.api-keys.index', compact('apiKeys'));
    }
}
