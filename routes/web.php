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

// Legal Routes
Route::get('/privacy-policy', function () { return view('legal.privacy'); })->name('privacy');
Route::get('/terms-of-service', function () { return view('legal.terms'); })->name('terms');
Route::get('/cookie-policy', function () { return view('legal.cookies'); })->name('cookies');
Route::get('/data-protection', function () { return view('legal.data-protection'); })->name('data-protection');

// Quote Route
Route::get('/request-quote', function () { return view('quote'); })->name('quote.request');
