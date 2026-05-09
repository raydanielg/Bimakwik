<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

use App\Http\Controllers\Api\KycController;
use App\Http\Controllers\Api\SupportController;
use App\Http\Controllers\Api\ProfileController;

Route::middleware('auth:sanctum')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'getProfile']);
    Route::post('/profile', [ProfileController::class, 'updateProfile']);

    // KYC
    Route::post('/kyc/submit', [KycController::class, 'submit']);
    Route::get('/kyc/status', [KycController::class, 'status']);

    // Support
    Route::post('/support/tickets', [SupportController::class, 'createTicket']);
    Route::get('/support/tickets', [SupportController::class, 'listTickets']);
    Route::get('/support/tickets/{id}', [SupportController::class, 'getTicketDetails']);
});
