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
    Route::middleware(['role:customer'])->prefix('customer')->name('customer.')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Customer\DashboardController::class, 'index'])->name('dashboard');
        Route::get('/profile', function() { return view('customer.profile'); })->name('profile');
        Route::get('/support', function() { return view('customer.support'); })->name('support');
    });

    Route::get('/admin/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])
        ->middleware('role:super-admin,sub-admin')
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
        ->middleware('role:service-provider')
        ->name('service-provider.dashboard');

    Route::get('/financing-partner/dashboard', [App\Http\Controllers\FinancingPartner\DashboardController::class, 'index'])
        ->middleware('role:financing-partner')
        ->name('financing-partner.dashboard');

    Route::get('/developer/dashboard', [App\Http\Controllers\Developer\DashboardController::class, 'index'])
        ->middleware('role:developer')
        ->name('developer.dashboard');
        
    Route::get('/dashboard', [App\Http\Controllers\Customer\DashboardController::class, 'index'])
        ->middleware('role:customer')
        ->name('customer.dashboard');
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
