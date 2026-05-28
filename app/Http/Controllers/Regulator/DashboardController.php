<?php

namespace App\Http\Controllers\Regulator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        return app(RegulatorDashboardController::class)->index($request);
    }
}
