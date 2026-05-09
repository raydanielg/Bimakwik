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

use App\Http\Controllers\Api\PolicyController;

Route::middleware('auth:sanctum')->group(function () {
    // ... previous routes ...

    // Policies
    Route::get('/policies/summary', [PolicyController::class, 'dashboardSummary']);
    Route::get('/policies/active', [PolicyController::class, 'activePolicies']);
    Route::get('/policies/history', [PolicyController::class, 'policyHistory']);
    Route::get('/policies/{id}/documents', [PolicyController::class, 'getDocuments']);
});
