<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/file01', function () {
    return view('documentation.file01.doc');
})->name('public.doc');

// Role-specific Registration Routes
Route::prefix('register')->name('register.')->group(function () {
    Route::get('/customer', function () { return view('auth.register-roles.customer'); })->name('customer');
    Route::get('/broker', function () { return view('auth.register-roles.broker'); })->name('broker');
    Route::get('/insurer', function () { return view('auth.register-roles.insurer'); })->name('insurer');
    Route::get('/provider', function () { return view('auth.register-roles.provider'); })->name('provider');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/newsletter/subscribe', [App\Http\Controllers\NewsletterController::class, 'store'])->name('newsletter.subscribe');

// Dashboards
Route::middleware(['auth'])->group(function () {
    // Customer Dashboard
    Route::middleware(['role:customer'])->prefix('customer')->name('customer.')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Customer\PortalController::class, 'dashboard'])->name('dashboard');
        Route::get('/profile', [App\Http\Controllers\Customer\PortalController::class, 'profile'])->name('profile');
        Route::get('/support', [App\Http\Controllers\Customer\PortalController::class, 'support'])->name('support');
        
        // AI & Marketplace
        Route::get('/ai-recommendations', [App\Http\Controllers\Customer\PortalController::class, 'aiRecommendations'])->name('ai-recommendations');
        Route::get('/marketplace', [App\Http\Controllers\Customer\PortalController::class, 'marketplace'])->name('marketplace');
        Route::get('/compare', [App\Http\Controllers\Customer\PortalController::class, 'compare'])->name('compare');
        Route::get('/buy', [App\Http\Controllers\Customer\PortalController::class, 'buy'])->name('buy');
        Route::get('/quote', [App\Http\Controllers\Customer\PortalController::class, 'quote'])->name('quote');
        
        // Insurance
        Route::get('/policies', [App\Http\Controllers\Customer\PortalController::class, 'policies'])->name('policies.index');
        Route::get('/renewals', [App\Http\Controllers\Customer\PortalController::class, 'renewals'])->name('policies.renewals');
        Route::get('/documents', [App\Http\Controllers\Customer\PortalController::class, 'documents'])->name('policies.documents');
        
        // Claims
        Route::get('/claims/create', [App\Http\Controllers\Customer\PortalController::class, 'claimsCreate'])->name('claims.create');
        Route::get('/claims/track', [App\Http\Controllers\Customer\PortalController::class, 'claimsTrack'])->name('claims.track');
        
        // Wallet
        Route::get('/wallet', [App\Http\Controllers\Customer\PortalController::class, 'wallet'])->name('wallet.index');
        Route::get('/wallet/add-funds', [App\Http\Controllers\Customer\PortalController::class, 'walletAddFunds'])->name('wallet.add-funds');
        Route::get('/wallet/history', [App\Http\Controllers\Customer\PortalController::class, 'walletHistory'])->name('wallet.history');
    });

    // Admin Dashboard Routes
    Route::prefix('admin')->name('admin.')->middleware('role:super_admin,admin,sub_admin')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
        
        // User Management Routes
        Route::prefix('users')->name('users.')->group(function () {
            Route::get('/', [App\Http\Controllers\SuperAdmin\UserManagementController::class, 'index'])->name('index');
            Route::get('/create', [App\Http\Controllers\SuperAdmin\UserManagementController::class, 'create'])->name('create');
            Route::post('/', [App\Http\Controllers\SuperAdmin\UserManagementController::class, 'store'])->name('store');
            Route::get('/{user}/edit', [App\Http\Controllers\SuperAdmin\UserManagementController::class, 'edit'])->name('edit');
            Route::put('/{user}', [App\Http\Controllers\SuperAdmin\UserManagementController::class, 'update'])->name('update');
            Route::delete('/{user}', [App\Http\Controllers\SuperAdmin\UserManagementController::class, 'destroy'])->name('destroy');
            
            // Specific user type routes
            Route::get('/admins', [App\Http\Controllers\SuperAdmin\UserManagementController::class, 'admins'])->name('admins');
            Route::get('/insurers', [App\Http\Controllers\SuperAdmin\UserManagementController::class, 'insurers'])->name('insurers');
            Route::get('/aggregators', [App\Http\Controllers\SuperAdmin\UserManagementController::class, 'aggregators'])->name('aggregators');
            Route::get('/aggregators/create', [App\Http\Controllers\SuperAdmin\UserManagementController::class, 'createAggregator'])->name('aggregators.create');
            Route::post('/aggregators', [App\Http\Controllers\SuperAdmin\UserManagementController::class, 'storeAggregator'])->name('aggregators.store');
            Route::get('/brokers', [App\Http\Controllers\SuperAdmin\UserManagementController::class, 'brokers'])->name('brokers');
            Route::get('/agents', [App\Http\Controllers\SuperAdmin\UserManagementController::class, 'agents'])->name('agents');
            Route::get('/customers', [App\Http\Controllers\SuperAdmin\UserManagementController::class, 'customers'])->name('customers');
            Route::get('/service-providers', [App\Http\Controllers\SuperAdmin\UserManagementController::class, 'serviceProviders'])->name('service-providers');
            Route::get('/rbac', [App\Http\Controllers\SuperAdmin\UserManagementController::class, 'rbacSettings'])->name('rbac');
        });

        // Product Management Routes
        Route::resource('products', App\Http\Controllers\Product\InsuranceProductController::class);
        Route::get('/products/compare/matrix', [App\Http\Controllers\Product\InsuranceProductController::class, 'compare'])->name('products.compare');
        
        // AI Insights
        Route::get('/ai-insights', [App\Http\Controllers\Admin\DashboardController::class, 'aiInsights'])->name('ai-insights');
        
        // Finance Routes
        Route::prefix('finance')->name('finance.')->group(function () {
            Route::get('/wallets', [App\Http\Controllers\Admin\FinanceController::class, 'wallets'])->name('wallets');
            Route::post('/wallets/seed-demo', [App\Http\Controllers\Admin\FinanceController::class, 'seedDemoData'])->name('wallets.seed-demo');
            Route::get('/wallets/{id}', [App\Http\Controllers\Admin\FinanceController::class, 'viewWallet'])->name('wallets.view');
            Route::post('/wallets/{id}/add-funds', [App\Http\Controllers\Admin\FinanceController::class, 'addFunds'])->name('wallets.add-funds');
            Route::post('/wallets/{id}/freeze', [App\Http\Controllers\Admin\FinanceController::class, 'freezeWallet'])->name('wallets.freeze');
            Route::post('/wallets/{id}/activate', [App\Http\Controllers\Admin\FinanceController::class, 'activateWallet'])->name('wallets.activate');
            Route::get('/premiums', [App\Http\Controllers\Admin\FinanceController::class, 'premiums'])->name('premiums');
            Route::get('/premiums/export', [App\Http\Controllers\Admin\FinanceController::class, 'exportPremiums'])->name('premiums.export');
            Route::get('/commissions', [App\Http\Controllers\Admin\FinanceController::class, 'commissions'])->name('commissions');
            Route::get('/payouts', [App\Http\Controllers\Admin\FinanceController::class, 'payouts'])->name('payouts');
            Route::post('/payouts/{id}/approve', [App\Http\Controllers\Admin\FinanceController::class, 'approvePayout'])->name('payouts.approve');
            Route::post('/payouts/{id}/reject', [App\Http\Controllers\Admin\FinanceController::class, 'rejectPayout'])->name('payouts.reject');
        });
        
        // Operations Routes
        Route::prefix('operations')->name('operations.')->group(function () {
            Route::get('/claims', [App\Http\Controllers\Admin\OperationsController::class, 'claims'])->name('claims');
            Route::get('/claims/{id}', [App\Http\Controllers\Admin\OperationsController::class, 'claimDetails'])->name('claims.show');
            Route::post('/claims/{id}/approve', [App\Http\Controllers\Admin\OperationsController::class, 'approveClaim'])->name('claims.approve');
            Route::post('/claims/{id}/reject', [App\Http\Controllers\Admin\OperationsController::class, 'rejectClaim'])->name('claims.reject');
            Route::get('/workflows', [App\Http\Controllers\Admin\OperationsController::class, 'workflows'])->name('workflows');
            Route::get('/documents', [App\Http\Controllers\Admin\OperationsController::class, 'documents'])->name('documents');
        });
        
        // Governance Routes
        Route::prefix('governance')->name('governance.')->group(function () {
            Route::get('/compliance', [App\Http\Controllers\Admin\GovernanceController::class, 'compliance'])->name('compliance');
            Route::get('/compliance/{id}/export', [App\Http\Controllers\Admin\GovernanceController::class, 'exportReport'])->name('compliance.export');
            Route::get('/analytics', [App\Http\Controllers\Admin\GovernanceController::class, 'analytics'])->name('analytics');
            Route::get('/communications', [App\Http\Controllers\Admin\GovernanceController::class, 'communications'])->name('communications');
            Route::post('/communications/send', [App\Http\Controllers\Admin\GovernanceController::class, 'sendCommunication'])->name('communications.send');
        });
        
        // System & Tech Routes
        Route::prefix('system')->name('system.')->group(function () {
            Route::get('/configurations', [App\Http\Controllers\Admin\SystemTechController::class, 'configurations'])->name('configurations');
            Route::post('/configurations', [App\Http\Controllers\Admin\SystemTechController::class, 'saveConfigurations'])->name('configurations.save');
            Route::get('/developer-portal', [App\Http\Controllers\Admin\SystemTechController::class, 'developerPortal'])->name('developer-portal');
            Route::get('/multi-country', [App\Http\Controllers\Admin\SystemTechController::class, 'multiCountry'])->name('multi-country');
            Route::get('/audit-logs', [App\Http\Controllers\Admin\SystemTechController::class, 'auditLogs'])->name('audit-logs');
        });
    });
        
    // Insurer Dashboard & Hub Routes
    Route::prefix('insurer')->name('insurer.')->middleware('role:insurer,super_admin,admin')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Insurer\DashboardController::class, 'index'])->name('dashboard');
        Route::get('/ai-insights', [App\Http\Controllers\Insurer\InsurerHubController::class, 'aiInsights'])->name('ai-insights');

        // Products
        Route::prefix('products')->name('products.')->group(function () {
            Route::get('/', [App\Http\Controllers\Insurer\InsurerHubController::class, 'products'])->name('index');
            Route::get('/categories', [App\Http\Controllers\Insurer\InsurerHubController::class, 'categories'])->name('categories');
            Route::get('/pricing', [App\Http\Controllers\Insurer\InsurerHubController::class, 'pricingRules'])->name('pricing');
            Route::get('/form-builder', [App\Http\Controllers\Insurer\InsurerHubController::class, 'formBuilder'])->name('form-builder');
            Route::get('/regulator-approval', [App\Http\Controllers\Insurer\InsurerHubController::class, 'regulatorApproval'])->name('regulator-approval');
        });

        // Policies
        Route::prefix('policies')->name('policies.')->group(function () {
            Route::get('/', [App\Http\Controllers\Insurer\InsurerHubController::class, 'policies'])->name('index');
            Route::get('/endorsements', [App\Http\Controllers\Insurer\InsurerHubController::class, 'endorsements'])->name('endorsements');
            Route::get('/cancellations', [App\Http\Controllers\Insurer\InsurerHubController::class, 'cancellations'])->name('cancellations');
            Route::get('/renewals', [App\Http\Controllers\Insurer\InsurerHubController::class, 'renewals'])->name('renewals');
        });

        // Claims
        Route::prefix('claims')->name('claims.')->group(function () {
            Route::get('/', [App\Http\Controllers\Insurer\InsurerHubController::class, 'claims'])->name('index');
            Route::get('/processing', [App\Http\Controllers\Insurer\InsurerHubController::class, 'claimsProcessing'])->name('processing');
            Route::get('/adjusters', [App\Http\Controllers\Insurer\InsurerHubController::class, 'adjusters'])->name('adjusters');
            Route::get('/fraud-alerts', [App\Http\Controllers\Insurer\InsurerHubController::class, 'fraudAlerts'])->name('fraud-alerts');
            Route::get('/tiramis', [App\Http\Controllers\Insurer\InsurerHubController::class, 'tiramis'])->name('tiramis');
        });

        // Network (Providers, Brokers, Agents)
        Route::prefix('network')->name('network.')->group(function () {
            Route::get('/providers', [App\Http\Controllers\Insurer\InsurerHubController::class, 'providers'])->name('providers');
            Route::get('/provider-slas', [App\Http\Controllers\Insurer\InsurerHubController::class, 'providerSlas'])->name('provider-slas');
            Route::get('/provider-bills', [App\Http\Controllers\Insurer\InsurerHubController::class, 'providerBills'])->name('provider-bills');
            Route::get('/brokers', [App\Http\Controllers\Insurer\InsurerHubController::class, 'brokers'])->name('brokers');
            Route::get('/agents', [App\Http\Controllers\Insurer\InsurerHubController::class, 'agents'])->name('agents');
            Route::get('/commission-rates', [App\Http\Controllers\Insurer\InsurerHubController::class, 'commissionRates'])->name('commission-rates');
            Route::get('/performance', [App\Http\Controllers\Insurer\InsurerHubController::class, 'partnerPerformance'])->name('performance');
        });

        // Customers
        Route::prefix('customers')->name('customers.')->group(function () {
            Route::get('/', [App\Http\Controllers\Insurer\InsurerHubController::class, 'customers'])->name('index');
            Route::get('/kyc', [App\Http\Controllers\Insurer\InsurerHubController::class, 'kycStatus'])->name('kyc');
        });

        // Finance
        Route::prefix('finance')->name('finance.')->group(function () {
            Route::get('/premiums', [App\Http\Controllers\Insurer\InsurerHubController::class, 'premiumsReport'])->name('premiums');
            Route::get('/commissions', [App\Http\Controllers\Insurer\InsurerHubController::class, 'commissionPayable'])->name('commissions');
            Route::get('/tax', [App\Http\Controllers\Insurer\InsurerHubController::class, 'taxStatements'])->name('tax');
        });

        // Reports
        Route::prefix('reports')->name('reports.')->group(function () {
            Route::get('/standard', [App\Http\Controllers\Insurer\InsurerHubController::class, 'reportsStandard'])->name('standard');
            Route::get('/custom', [App\Http\Controllers\Insurer\InsurerHubController::class, 'reportsCustom'])->name('custom');
            Route::get('/predictive', [App\Http\Controllers\Insurer\InsurerHubController::class, 'reportsPredictive'])->name('predictive');
        });

        // Settings
        Route::prefix('settings')->name('settings.')->group(function () {
            Route::get('/company', [App\Http\Controllers\Insurer\InsurerHubController::class, 'companyProfile'])->name('company');
            Route::get('/branches', [App\Http\Controllers\Insurer\InsurerHubController::class, 'branches'])->name('branches');
            Route::get('/staff', [App\Http\Controllers\Insurer\InsurerHubController::class, 'staffRoles'])->name('staff');
            Route::get('/api', [App\Http\Controllers\Insurer\InsurerHubController::class, 'apiWebhooks'])->name('api');
        });
    });

    // Broker Routes
    Route::prefix('broker')->name('broker.')->middleware('role:broker')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Broker\DashboardController::class, 'index'])->name('dashboard');
        Route::get('/policies', [App\Http\Controllers\Broker\BrokerHubController::class, 'policies'])->name('policies');
        Route::get('/customers', [App\Http\Controllers\Broker\BrokerHubController::class, 'customers'])->name('customers');
        Route::get('/commissions', [App\Http\Controllers\Broker\BrokerHubController::class, 'commissions'])->name('commissions');
        Route::get('/reports', [App\Http\Controllers\Broker\BrokerHubController::class, 'reports'])->name('reports');
        Route::get('/products', [App\Http\Controllers\Broker\BrokerHubController::class, 'products'])->name('products');
        Route::get('/claims', [App\Http\Controllers\Broker\BrokerHubController::class, 'claims'])->name('claims');
    });

    // Aggregator Routes
    Route::prefix('aggregator')->name('aggregator.')->middleware('role:aggregator')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Aggregator\DashboardController::class, 'index'])->name('dashboard');
        Route::get('/policies', [App\Http\Controllers\Aggregator\AggregatorHubController::class, 'policies'])->name('policies');
        Route::get('/customers', [App\Http\Controllers\Aggregator\AggregatorHubController::class, 'customers'])->name('customers');
        Route::get('/commissions', [App\Http\Controllers\Aggregator\AggregatorHubController::class, 'commissions'])->name('commissions');
        Route::get('/reports', [App\Http\Controllers\Aggregator\AggregatorHubController::class, 'reports'])->name('reports');
        Route::get('/brokers', [App\Http\Controllers\Aggregator\AggregatorHubController::class, 'brokers'])->name('brokers');
        Route::get('/agents', [App\Http\Controllers\Aggregator\AggregatorHubController::class, 'agents'])->name('agents');
        Route::get('/products', [App\Http\Controllers\Aggregator\AggregatorHubController::class, 'products'])->name('products');
    });

    // Agent Routes
    Route::prefix('agent')->name('agent.')->middleware('role:sfe,bancassurance')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Agent\AgentDashboardController::class, 'index'])->name('dashboard');
        Route::get('/policies', [App\Http\Controllers\Agent\AgentHubController::class, 'policies'])->name('policies');
        Route::get('/customers', [App\Http\Controllers\Agent\AgentHubController::class, 'customers'])->name('customers');
        Route::get('/commissions', [App\Http\Controllers\Agent\AgentHubController::class, 'commissions'])->name('commissions');
        Route::get('/reports', [App\Http\Controllers\Agent\AgentHubController::class, 'reports'])->name('reports');
        Route::get('/products', [App\Http\Controllers\Agent\AgentHubController::class, 'products'])->name('products');
        Route::get('/claims', [App\Http\Controllers\Agent\AgentHubController::class, 'claims'])->name('claims');
    });

    Route::prefix('service-provider')->name('service-provider.')->middleware(['auth', 'role:service_provider'])->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\ServiceProvider\DashboardController::class, 'index'])->name('dashboard');
        Route::get('/customer/verify', [App\Http\Controllers\ServiceProvider\CustomerController::class, 'index'])->name('customer.verify');
        Route::get('/claims', [App\Http\Controllers\ServiceProvider\ClaimController::class, 'index'])->name('claims.index');
        Route::get('/payments', [App\Http\Controllers\ServiceProvider\PaymentController::class, 'index'])->name('payments.index');
        Route::get('/agreements', [App\Http\Controllers\ServiceProvider\AgreementController::class, 'index'])->name('agreements.index');
        Route::get('/performance', [App\Http\Controllers\ServiceProvider\PerformanceController::class, 'index'])->name('performance.index');
        Route::get('/bank-details', [App\Http\Controllers\ServiceProvider\BankController::class, 'index'])->name('bank.index');
        Route::get('/support', [App\Http\Controllers\ServiceProvider\SupportController::class, 'index'])->name('support.index');
    });

    // Premium Financing Partner Dashboard Routes
    Route::prefix('financing-partner')->name('financing-partner.')->middleware(['auth', 'role:financing_partner'])->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\FinancingPartner\DashboardController::class, 'index'])->name('dashboard');
        Route::get('/requests', [App\Http\Controllers\FinancingPartner\LoanRequestController::class, 'index'])->name('requests.index');
        Route::get('/disbursements', [App\Http\Controllers\FinancingPartner\DisbursementController::class, 'index'])->name('disbursements.index');
        Route::get('/repayments', [App\Http\Controllers\FinancingPartner\RepaymentController::class, 'index'])->name('repayments.index');
        Route::get('/collections', [App\Http\Controllers\FinancingPartner\CollectionController::class, 'index'])->name('collections.index');
        Route::get('/reports', [App\Http\Controllers\FinancingPartner\ReportController::class, 'index'])->name('reports.index');
        Route::get('/settings', [App\Http\Controllers\FinancingPartner\SettingsController::class, 'index'])->name('settings.index');
    });

    // Developer Dashboard Routes
    Route::prefix('developer')->name('developer.')->middleware(['auth', 'role:developer'])->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Developer\DashboardController::class, 'index'])->name('dashboard');
        Route::get('/apps', [App\Http\Controllers\Developer\AppController::class, 'index'])->name('apps.index');
        Route::get('/keys', [App\Http\Controllers\Developer\ApiKeyController::class, 'index'])->name('keys.index');
        Route::get('/docs', [App\Http\Controllers\Developer\DocumentationController::class, 'index'])->name('docs.index');
        Route::get('/testing', [App\Http\Controllers\Developer\TestingController::class, 'index'])->name('testing.index');
        Route::get('/webhooks', [App\Http\Controllers\Developer\WebhookController::class, 'index'])->name('webhooks.index');
        Route::get('/usage', [App\Http\Controllers\Developer\UsageController::class, 'index'])->name('usage.index');
        Route::get('/sandbox', [App\Http\Controllers\Developer\SandboxController::class, 'index'])->name('sandbox.index');
        Route::get('/profile', [App\Http\Controllers\Developer\ProfileController::class, 'index'])->name('profile.index');
    });

    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])
        ->name('dashboard');
    
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])
        ->name('profile');
    
    Route::post('/profile', [App\Http\Controllers\ProfileController::class, 'update']);
    Route::post('/profile/password', [App\Http\Controllers\ProfileController::class, 'updatePassword']);
    Route::post('/profile/avatar', [App\Http\Controllers\ProfileController::class, 'uploadAvatar']);
    Route::post('/profile/2fa', [App\Http\Controllers\ProfileController::class, 'toggle2FA']);

    // SFE Dashboard Routes
    Route::prefix('sfe')->name('sfe.')->middleware(['auth', 'role:sfe'])->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Sfe\DashboardController::class, 'index'])->name('dashboard');
        
        // Customer Management
        Route::get('/customers', [App\Http\Controllers\Sfe\CustomerController::class, 'index'])->name('customers.index');
        Route::get('/customers/create', [App\Http\Controllers\Sfe\CustomerController::class, 'create'])->name('customers.create');
        Route::get('/customers/kyc', [App\Http\Controllers\Sfe\CustomerController::class, 'kycStatus'])->name('customers.kyc');
        
        // Policy Management
        Route::get('/policies', [App\Http\Controllers\Sfe\PolicyController::class, 'index'])->name('policies.index');
        Route::get('/policies/buy', [App\Http\Controllers\Sfe\PolicyController::class, 'create'])->name('policies.buy');
        
        // Product Catalog
        Route::get('/products', [App\Http\Controllers\Sfe\ProductController::class, 'index'])->name('products.index');
        
        // Claims
        Route::get('/claims', [App\Http\Controllers\Sfe\ClaimController::class, 'index'])->name('claims.index');
        Route::get('/claims/submit', [App\Http\Controllers\Sfe\ClaimController::class, 'create'])->name('claims.submit');
        
        // Commissions & Wallet
        Route::get('/commissions', [App\Http\Controllers\Sfe\CommissionController::class, 'index'])->name('commissions.index');
        
        // Sales & Performance
        Route::get('/performance', [App\Http\Controllers\Sfe\SalesReportController::class, 'index'])->name('performance.index');
        
        // Training
        Route::get('/training', [App\Http\Controllers\Sfe\TrainingController::class, 'index'])->name('training.index');
        
        // Support
        Route::get('/support', [App\Http\Controllers\Sfe\SupportController::class, 'index'])->name('support.index');
        
        // Profile
        Route::get('/profile', [App\Http\Controllers\Sfe\ProfileController::class, 'index'])->name('profile.index');
    });

    // Bancassurance Dashboard Routes
    Route::prefix('bancassurance')->name('bancassurance.')->middleware(['auth', 'role:bancassurance'])->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Bancassurance\DashboardController::class, 'index'])->name('dashboard');
        Route::get('/integration', [App\Http\Controllers\Bancassurance\BankIntegrationController::class, 'index'])->name('integration');
        Route::post('/integration', [App\Http\Controllers\Bancassurance\BankIntegrationController::class, 'store']);
        Route::post('/integration/sync/{id}', [App\Http\Controllers\Bancassurance\BankIntegrationController::class, 'sync'])->name('integration.sync');
        Route::post('/integration/status/{id}', [App\Http\Controllers\Bancassurance\BankIntegrationController::class, 'updateStatus']);
        Route::get('/integration/settings/{id}', [App\Http\Controllers\Bancassurance\BankIntegrationController::class, 'getSettings']);
        Route::post('/integration/settings/{id}', [App\Http\Controllers\Bancassurance\BankIntegrationController::class, 'updateSettings']);
        Route::post('/integration/setup/{id}', [App\Http\Controllers\Bancassurance\BankIntegrationController::class, 'setup']);
        Route::post('/integration/test-connection', [App\Http\Controllers\Bancassurance\BankIntegrationController::class, 'testConnection']);
        Route::get('/integration/report/{id}', [App\Http\Controllers\Bancassurance\BankIntegrationController::class, 'generateReport']);
        Route::get('/customers', [App\Http\Controllers\Bancassurance\CustomerController::class, 'index'])->name('customers');
        Route::post('/customers', [App\Http\Controllers\Bancassurance\CustomerController::class, 'store']);
        Route::get('/customers/{id}', [App\Http\Controllers\Bancassurance\CustomerController::class, 'show']);
        Route::post('/customers/export', [App\Http\Controllers\Bancassurance\CustomerController::class, 'export']);
        Route::get('/sales', [App\Http\Controllers\Bancassurance\PolicyController::class, 'sales'])->name('sales');
        Route::post('/sales', [App\Http\Controllers\Bancassurance\PolicyController::class, 'storeSale']);
        Route::get('/sales/{id}', [App\Http\Controllers\Bancassurance\PolicyController::class, 'showSale']);
        Route::post('/sales/export', [App\Http\Controllers\Bancassurance\PolicyController::class, 'exportSales']);
        Route::post('/sales/{id}', [App\Http\Controllers\Bancassurance\PolicyController::class, 'updateSale']);
        Route::get('/my-sales', [App\Http\Controllers\Bancassurance\PolicyController::class, 'mySales'])->name('my-sales');
        Route::get('/products', [App\Http\Controllers\Bancassurance\ProductController::class, 'index'])->name('products');
        Route::post('/products', [App\Http\Controllers\Bancassurance\ProductController::class, 'store']);
        Route::get('/products/{id}', [App\Http\Controllers\Bancassurance\ProductController::class, 'show']);
        Route::post('/products/{id}', [App\Http\Controllers\Bancassurance\ProductController::class, 'update']);
        Route::delete('/products/{id}', [App\Http\Controllers\Bancassurance\ProductController::class, 'destroy']);
        Route::post('/reports/generate', [App\Http\Controllers\Bancassurance\ComplianceController::class, 'generateReport']);
        Route::get('/reports/{id}/download', [App\Http\Controllers\Bancassurance\ComplianceController::class, 'downloadReport']);
        Route::get('/reports/{id}', [App\Http\Controllers\Bancassurance\ComplianceController::class, 'showReport']);
        Route::get('/reports', [App\Http\Controllers\Bancassurance\ComplianceController::class, 'reports'])->name('reports');
        Route::get('/compliance', [App\Http\Controllers\Bancassurance\ComplianceController::class, 'index'])->name('compliance');
        Route::post('/compliance/checks', [App\Http\Controllers\Bancassurance\ComplianceController::class, 'storeCheck']);
        Route::get('/compliance/checks/{id}', [App\Http\Controllers\Bancassurance\ComplianceController::class, 'showCheck']);
        Route::post('/compliance/checks/{id}', [App\Http\Controllers\Bancassurance\ComplianceController::class, 'updateCheck']);
        Route::get('/performance', [App\Http\Controllers\Bancassurance\PerformanceController::class, 'index'])->name('performance');
        Route::get('/policies', [App\Http\Controllers\Bancassurance\PolicyController::class, 'index'])->name('policies.index');
    });

    Route::get('/agent/dashboard', [App\Http\Controllers\Agent\DashboardController::class, 'index'])
        ->middleware('role:agent,sfe,bancassurance')
        ->name('agent.dashboard');

    Route::get('/regulator/dashboard', [App\Http\Controllers\Regulator\DashboardController::class, 'index'])
        ->middleware('role:regulator')
        ->name('regulator.dashboard');
        
    Route::get('/customer/dashboard', [App\Http\Controllers\Customer\PortalController::class, 'dashboard'])
        ->middleware('role:customer')
        ->name('customer.dashboard');

    // Add GET logout support to fix MethodNotAllowedHttpException
    Route::get('/logout', function () {
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    })->name('logout.get');
});

// Legal Routes
Route::get('/privacy-policy', function () { return view('legal.privacy'); })->name('legal.privacy');
Route::get('/terms-conditions', function () { return view('legal.terms'); })->name('legal.terms');
Route::get('/cookies-policy', function () { return view('legal.cookies'); })->name('legal.cookies');
Route::get('/data-protection', function () { return view('legal.data-protection'); })->name('legal.data-protection');

// Placeholder routes for new menu structure
Route::prefix('platform')->name('platform.')->group(function () {
    Route::get('/overview', function () { return view('platform.overview'); })->name('overview');
    Route::get('/for-customers', function () { return view('platform.customers'); })->name('customers');
    Route::get('/for-businesses', function () { return view('platform.businesses'); })->name('businesses');
    Route::get('/technology', function () { return view('platform.technology'); })->name('technology');
});

Route::prefix('partners')->name('partners.')->group(function () {
    Route::get('/brokers', function () { return view('partners.brokers'); })->name('brokers');
    Route::get('/aggregators', function () { return view('partners.aggregators'); })->name('aggregators');
    Route::get('/service-providers', function () { return view('partners.providers'); })->name('providers');
    Route::get('/affiliates', function () { return view('partners.affiliates'); })->name('affiliates');
});

// Product Routes
Route::prefix('products')->name('products.')->group(function () {
    Route::get('/health', function () { return view('products.health'); })->name('health');
    Route::get('/life', function () { return view('products.life'); })->name('life');
    Route::get('/general', function () { return view('products.general'); })->name('general');
});

// Company Routes
Route::prefix('company')->name('company.')->group(function () {
    Route::get('/our-story', function () { return view('company.story'); })->name('story');
    Route::get('/leadership', function () { return view('company.leadership'); })->name('leadership');
    Route::get('/careers', function () { return view('company.careers'); })->name('careers');
});

Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'sw'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('lang.switch');

// Support Routes
Route::get('/help-center', function () { return view('support.help-center'); })->name('support.help');
Route::get('/faqs', function () { return view('support.faqs'); })->name('support.faqs');

// Professional Page Routes
Route::get('/about-us', function () { return view('pages.about'); })->name('pages.about');
Route::get('/products', function () { 
    $products = \App\Models\Product::where('is_active', true)->get();
    return view('pages.products', compact('products')); 
})->name('pages.products');
Route::get('/branches', function () { 
    $branches = \App\Models\Branch::all();
    return view('pages.branches', compact('branches')); 
})->name('pages.branches');
Route::get('/claims', function () { return view('pages.claims'); })->name('pages.claims');
Route::get('/contact-us', [App\Http\Controllers\ContactController::class, 'show'])->name('pages.contact');
Route::post('/contact-us', [App\Http\Controllers\ContactController::class, 'store'])->name('pages.contact.store');

// Resources Routes
Route::get('/guidelines-materials', function () {
    return view('resources.guidelines');
})->name('resources.guidelines');

// Guideline Detail Routes
Route::get('/guidelines/claim-process', function () {
    return view('resources.guideline_claim');
})->name('guidelines.claim-process');
Route::get('/guidelines/policy-management', function () {
    return view('resources.guideline_policy');
})->name('guidelines.policy-management');
Route::get('/guidelines/kyc-verification', function () {
    return view('resources.guideline_kyc');
})->name('guidelines.kyc-verification');

Route::get('/news-research', [App\Http\Controllers\NewsController::class, 'index'])->name('resources.news');
Route::get('/news-research/{slug}', [App\Http\Controllers\NewsController::class, 'show'])->name('resources.news-detail');

// Quote Routes
Route::get('/request-quote', [App\Http\Controllers\QuoteController::class, 'show'])->name('quote.request');
Route::post('/request-quote', [App\Http\Controllers\QuoteController::class, 'store'])->name('quote.store');
