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
        Route::get('/dashboard', [App\Http\Controllers\Customer\DashboardController::class, 'index'])->name('dashboard');
        Route::get('/profile', function() { return view('customer.profile'); })->name('profile');
        Route::get('/support', function() { return view('customer.support'); })->name('support');
        
        // AI & Marketplace
        Route::get('/ai-recommendations', function() { return view('customer.ai-recommendations'); })->name('ai-recommendations');
        Route::get('/marketplace', function() { return view('customer.marketplace'); })->name('marketplace');
        Route::get('/compare', function() { return view('customer.compare'); })->name('compare');
        Route::get('/buy', function() { return view('customer.buy'); })->name('buy');
        
        // Insurance
        Route::get('/policies', function() { return view('customer.policies.index'); })->name('policies.index');
        Route::get('/renewals', function() { return view('customer.policies.renewals'); })->name('policies.renewals');
        Route::get('/documents', function() { return view('customer.policies.documents'); })->name('policies.documents');
        
        // Claims
        Route::get('/claims/create', function() { return view('customer.claims.create'); })->name('claims.create');
        Route::get('/claims/track', function() { return view('customer.claims.track'); })->name('claims.track');
        
        // Wallet
        Route::get('/wallet', function() { return view('customer.wallet.index'); })->name('wallet.index');
        Route::get('/wallet/add-funds', function() { return view('customer.wallet.add-funds'); })->name('wallet.add-funds');
        Route::get('/wallet/history', function() { return view('customer.wallet.history'); })->name('wallet.history');
    });

    Route::get('/admin/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])
        ->middleware('role:super_admin,admin,sub_admin')
        ->name('admin.dashboard');
        
    Route::get('/insurer/dashboard', [App\Http\Controllers\Insurer\DashboardController::class, 'index'])
        ->middleware('role:insurer')
        ->name('insurer.dashboard');

    Route::get('/broker/dashboard', [App\Http\Controllers\Broker\DashboardController::class, 'index'])
        ->middleware('role:broker')
        ->name('broker.dashboard');

    Route::get('/aggregator/dashboard', [App\Http\Controllers\Aggregator\DashboardController::class, 'index'])
        ->middleware('role:aggregator')
        ->name('aggregator.dashboard');

    Route::get('/service-provider/dashboard', [App\Http\Controllers\ServiceProvider\DashboardController::class, 'index'])
        ->middleware('role:service_provider')
        ->name('service-provider.dashboard');

    Route::get('/financing-partner/dashboard', [App\Http\Controllers\FinancingPartner\DashboardController::class, 'index'])
        ->middleware('role:financing_partner')
        ->name('financing-partner.dashboard');

    Route::get('/developer/dashboard', [App\Http\Controllers\Developer\DashboardController::class, 'index'])
        ->middleware('role:developer')
        ->name('developer.dashboard');
        
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])
        ->name('dashboard');

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

    Route::get('/agent/dashboard', [App\Http\Controllers\Agent\DashboardController::class, 'index'])
        ->middleware('role:agent,sfe,bancassurance')
        ->name('agent.dashboard');

    Route::get('/regulator/dashboard', [App\Http\Controllers\Regulator\DashboardController::class, 'index'])
        ->middleware('role:regulator')
        ->name('regulator.dashboard');
        
    Route::get('/customer/dashboard', [App\Http\Controllers\Customer\DashboardController::class, 'index'])
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
