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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/newsletter/subscribe', [App\Http\Controllers\NewsletterController::class, 'store'])->name('newsletter.subscribe');

// Dashboards
Route::middleware(['auth'])->group(function () {
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
Route::get('/privacy-policy', function () { return view('legal.privacy'); })->name('privacy');
Route::get('/terms-of-service', function () { return view('legal.terms'); })->name('terms');
Route::get('/cookie-policy', function () { return view('legal.cookies'); })->name('cookies');
Route::get('/data-protection', function () { return view('legal.data-protection'); })->name('data-protection');

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
Route::get('/contact-us', function () { return view('pages.contact'); })->name('pages.contact');

// Resources Routes
Route::get('/guidelines-materials', function () { return view('resources.guidelines'); })->name('resources.guidelines');
Route::get('/news-research', function () { return view('resources.news'); })->name('resources.news');

// Quote Route
Route::get('/request-quote', function () { return view('quote'); })->name('quote.request');
