<?php

namespace App\Http\Controllers\Insurer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InsuranceProduct;
use App\Models\Claim;
use App\Models\User;
use App\Models\InsurerBranch;
use App\Models\ServiceProvider;
use App\Models\BrokerCommission;
use App\Models\AgentCommission;
use App\Models\PaymentTransaction;
use App\Models\InsurerContract;
use App\Models\PolicyEndorsement;
use App\Models\PolicyCancellation;
use App\Models\PolicyRenewal;
use App\Models\Report;
use Illuminate\Support\Facades\DB;

class InsurerHubController extends Controller
{
    /* ============== PRODUCTS ============== */
    public function products()
    {
        $products = collect(); $count = 0; $approvedCount = 0;
        try {
            $products = InsuranceProduct::latest()->paginate(15);
            $count = InsuranceProduct::count();
            $approvedCount = InsuranceProduct::where('status', 'approved')->count();
        } catch (\Exception $e) {}
        return view('insurer.products.index', compact('products', 'count', 'approvedCount'));
    }

    public function categories()
    {
        $categories = collect();
        try { $categories = \App\Models\ProductCategory::withCount('products')->get(); } catch (\Exception $e) {}
        return view('insurer.products.categories', compact('categories'));
    }

    public function pricingRules()
    {
        $rules = collect();
        try { $rules = \App\Models\PremiumCalculationRule::latest()->paginate(15); } catch (\Exception $e) {}
        return view('insurer.products.pricing', compact('rules'));
    }

    public function formBuilder()
    {
        $forms = collect();
        try { $forms = \App\Models\DynamicForm::latest()->paginate(15); } catch (\Exception $e) {}
        return view('insurer.products.form-builder', compact('forms'));
    }

    public function regulatorApproval()
    {
        $pending = collect();
        try {
            $pending = InsuranceProduct::where('status', 'pending_approval')->latest()->paginate(15);
        } catch (\Exception $e) {}
        return view('insurer.products.regulator-approval', compact('pending'));
    }

    /* ============== POLICIES ============== */
    public function policies()
    {
        $policies = collect(); $totalCount = 0; $activeCount = 0; $expiredCount = 0;
        try {
            $policies = \App\Models\CustomerPolicy::with('customer','product')->latest()->paginate(15);
            $totalCount = \App\Models\CustomerPolicy::count();
            $activeCount = \App\Models\CustomerPolicy::where('status', 'active')->count();
            $expiredCount = \App\Models\CustomerPolicy::where('status', 'expired')->count();
        } catch (\Exception $e) {}
        return view('insurer.policies.index', compact('policies', 'totalCount', 'activeCount', 'expiredCount'));
    }

    public function endorsements()
    {
        $endorsements = collect();
        try { $endorsements = PolicyEndorsement::latest()->paginate(15); } catch (\Exception $e) {}
        return view('insurer.policies.endorsements', compact('endorsements'));
    }

    public function cancellations()
    {
        $cancellations = collect();
        try { $cancellations = PolicyCancellation::latest()->paginate(15); } catch (\Exception $e) {}
        return view('insurer.policies.cancellations', compact('cancellations'));
    }

    public function renewals()
    {
        $renewals = collect();
        try { $renewals = PolicyRenewal::latest()->paginate(15); } catch (\Exception $e) {}
        return view('insurer.policies.renewals', compact('renewals'));
    }

    /* ============== CLAIMS ============== */
    public function claims()
    {
        $claims = collect(); $stats = ['total' => 0, 'pending' => 0, 'approved' => 0, 'rejected' => 0];
        try {
            $claims = Claim::with('customer')->latest()->paginate(15);
            $stats['total'] = Claim::count();
            $stats['pending'] = Claim::where('status', 'pending')->count();
            $stats['approved'] = Claim::where('status', 'approved')->count();
            $stats['rejected'] = Claim::where('status', 'rejected')->count();
        } catch (\Exception $e) {}
        return view('insurer.claims.index', compact('claims', 'stats'));
    }

    public function claimsProcessing()
    {
        $processing = collect();
        try { $processing = Claim::whereIn('status', ['pending', 'processing'])->latest()->paginate(15); } catch (\Exception $e) {}
        return view('insurer.claims.processing', compact('processing'));
    }

    public function adjusters()
    {
        $adjusters = collect();
        try { $adjusters = \App\Models\ClaimAdjuster::latest()->paginate(15); } catch (\Exception $e) {}
        return view('insurer.claims.adjusters', compact('adjusters'));
    }

    public function fraudAlerts()
    {
        $alerts = collect();
        try { $alerts = \App\Models\ClaimFraudAlert::latest()->paginate(15); } catch (\Exception $e) {}
        return view('insurer.claims.fraud-alerts', compact('alerts'));
    }

    public function tiramis()
    {
        $reports = \App\Models\TirAmisReport::where('company_code', auth()->user()->insurer?->company_code)
            ->orWhere('submitted_by_id', auth()->id())
            ->latest()
            ->paginate(15);
        $stats = [
            'total' => \App\Models\TirAmisReport::count(),
            'sent' => \App\Models\TirAmisReport::where('status', 'sent')->count(),
            'failed' => \App\Models\TirAmisReport::where('status', 'failed')->count(),
            'pending' => \App\Models\TirAmisReport::whereIn('status', ['pending', 'simulated'])->count(),
        ];
        return view('insurer.claims.tiramis', compact('reports', 'stats'));
    }

    /* ============== NETWORK / PROVIDERS / BROKERS ============== */
    public function providers()
    {
        $providers = collect();
        try { $providers = ServiceProvider::with('serviceProviderType')->latest()->paginate(15); } catch (\Exception $e) {}
        return view('insurer.network.providers', compact('providers'));
    }

    public function providerSlas()
    {
        $slas = collect();
        try { $slas = \App\Models\ServiceProviderServiceLevelAgreement::latest()->paginate(15); } catch (\Exception $e) {}
        return view('insurer.network.provider-slas', compact('slas'));
    }

    public function providerBills()
    {
        $bills = collect();
        try { $bills = \App\Models\ServiceProviderPayment::latest()->paginate(15); } catch (\Exception $e) {}
        return view('insurer.network.provider-bills', compact('bills'));
    }

    public function brokers()
    {
        $brokers = collect();
        try { $brokers = User::role('broker')->with('brokerProfile')->paginate(15); } catch (\Exception $e) {}
        return view('insurer.network.brokers', compact('brokers'));
    }

    public function agents()
    {
        $agents = collect();
        try { $agents = User::role(['sfe', 'bancassurance'])->with('agentProfile')->paginate(15); } catch (\Exception $e) {}
        return view('insurer.network.agents', compact('agents'));
    }

    public function commissionRates()
    {
        return view('insurer.network.commission-rates');
    }

    public function partnerPerformance()
    {
        return view('insurer.network.performance');
    }

    /* ============== CUSTOMERS ============== */
    public function customers()
    {
        $customers = collect();
        try { $customers = User::role('customer')->with('customerProfile')->paginate(15); } catch (\Exception $e) {}
        return view('insurer.customers.index', compact('customers'));
    }

    public function kycStatus()
    {
        $kyc = collect();
        try { $kyc = \App\Models\CustomerKycSubmission::with('customer')->latest()->paginate(15); } catch (\Exception $e) {}
        return view('insurer.customers.kyc', compact('kyc'));
    }

    /* ============== FINANCE & REPORTS ============== */
    public function premiumsReport()
    {
        $premiums = collect(); $totalAmount = 0;
        try {
            $premiums = PaymentTransaction::latest()->paginate(15);
            $totalAmount = PaymentTransaction::sum('amount') ?? 0;
        } catch (\Exception $e) {}
        return view('insurer.finance.premiums', compact('premiums', 'totalAmount'));
    }

    public function commissionPayable()
    {
        $brokerComm = collect(); $agentComm = collect();
        try {
            $brokerComm = BrokerCommission::latest()->paginate(15);
            $agentComm = AgentCommission::latest()->paginate(15);
        } catch (\Exception $e) {}
        return view('insurer.finance.commissions', compact('brokerComm', 'agentComm'));
    }

    public function taxStatements()
    {
        return view('insurer.finance.tax');
    }

    public function reportsStandard()
    {
        $reports = collect();
        try { $reports = Report::where('created_by', auth()->id())->latest()->paginate(15); } catch (\Exception $e) {}
        return view('insurer.reports.standard', compact('reports'));
    }

    public function generateStandardReport(Request $request)
    {
        $validated = $request->validate([
            'report_type' => 'required|string|max:100',
            'period' => 'nullable|string|max:100',
        ]);

        Report::create([
            'report_name' => $validated['report_type'] . ' - ' . now()->format('Y-m-d H:i'),
            'report_type' => $validated['report_type'],
            'parameters' => ['period' => $validated['period'] ?? 'Current Month'],
            'is_system' => false,
            'is_active' => true,
            'created_by' => auth()->id(),
        ]);

        return back()->with('success', 'Report generated successfully');
    }

    public function viewStandardReport(Report $report)
    {
        abort_unless((int) $report->created_by === (int) auth()->id(), 403);

        return view('shared.reports.show', [
            'report' => $report,
            'backRoute' => 'insurer.reports.standard',
        ]);
    }

    public function downloadStandardReport(Report $report)
    {
        abort_unless((int) $report->created_by === (int) auth()->id(), 403);

        $content = "Report Name: " . ($report->report_name ?? 'N/A') . "\n"
            . "Report Type: " . ($report->report_type ?? 'N/A') . "\n"
            . "Generated At: " . (optional($report->created_at)->format('Y-m-d H:i:s') ?? 'N/A') . "\n"
            . "Parameters: " . json_encode($report->parameters ?? [], JSON_PRETTY_PRINT) . "\n";

        return response()->streamDownload(function () use ($content) {
            echo $content;
        }, 'report-' . $report->id . '.txt', ['Content-Type' => 'text/plain']);
    }

    public function exportStandardReports()
    {
        $reports = Report::where('created_by', auth()->id())->latest()->get();

        return response()->streamDownload(function () use ($reports) {
            $out = fopen('php://output', 'w');
            fputcsv($out, ['Report Name', 'Type', 'Period', 'Generated At']);

            foreach ($reports as $report) {
                fputcsv($out, [
                    $report->report_name,
                    $report->report_type,
                    $report->parameters['period'] ?? 'Current Month',
                    optional($report->created_at)->format('Y-m-d H:i:s'),
                ]);
            }

            fclose($out);
        }, 'insurer-standard-reports.csv', ['Content-Type' => 'text/csv']);
    }
    public function reportsCustom()
    {
        $reports = collect();
        try { $reports = \App\Models\CustomReport::latest()->paginate(15); } catch (\Exception $e) {}
        return view('insurer.reports.custom', compact('reports'));
    }

    public function reportsPredictive()
    {
        $reports = collect();
        try { $reports = \App\Models\PredictiveAnalyticsReport::latest()->paginate(15); } catch (\Exception $e) {}
        return view('insurer.reports.predictive', compact('reports'));
    }

    /* ============== ADMINISTRATION ============== */
    public function companyProfile()
    {
        $user = auth()->user();
        return view('insurer.settings.company', compact('user'));
    }

    public function branches()
    {
        $branches = collect();
        try { $branches = InsurerBranch::latest()->paginate(15); } catch (\Exception $e) {}
        return view('insurer.settings.branches', compact('branches'));
    }

    public function staffRoles()
    {
        $staff = collect();
        try { $staff = \App\Models\InsurerAdmin::latest()->paginate(15); } catch (\Exception $e) {}
        return view('insurer.settings.staff', compact('staff'));
    }

    public function apiWebhooks()
    {
        $apiKeys = collect(); $webhooks = collect();
        try {
            $apiKeys = \App\Models\ApiKey::latest()->limit(10)->get();
            $webhooks = \App\Models\Webhook::latest()->limit(10)->get();
        } catch (\Exception $e) {}
        return view('insurer.settings.api', compact('apiKeys', 'webhooks'));
    }

    public function deleteBranch($id)
    {
        try {
            InsurerBranch::findOrFail($id)->delete();
            return back()->with('success', 'Branch deleted successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete branch: ' . $e->getMessage());
        }
    }

    public function deleteStaff($id)
    {
        try {
            \App\Models\InsurerAdmin::findOrFail($id)->delete();
            return back()->with('success', 'Staff member deleted successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete staff member: ' . $e->getMessage());
        }
    }

    public function deleteApiKey($id)
    {
        try {
            \App\Models\ApiKey::findOrFail($id)->delete();
            return back()->with('success', 'API key deleted successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete API key: ' . $e->getMessage());
        }
    }

    public function deleteWebhook($id)
    {
        try {
            \App\Models\Webhook::findOrFail($id)->delete();
            return back()->with('success', 'Webhook deleted successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete webhook: ' . $e->getMessage());
        }
    }

    public function aiInsights()
    {
        return view('insurer.ai-insights');
    }
}
