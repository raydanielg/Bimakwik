<?php

namespace App\Http\Controllers\ServiceProvider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Claim;
use App\Models\ServiceProviderPayment;

class PerformanceController extends Controller
{
    public function index()
    {
        $stats = [
            'bills_processed' => 0,
            'approval_rate' => 0,
            'avg_processing_time' => 0,
            'rating' => 0,
        ];

        try {
            $billsProcessed = Claim::where('service_provider_id', auth()->id())->count() ?? 0;
            $approved = Claim::where('service_provider_id', auth()->id())->where('status', 'approved')->count() ?? 0;
            
            $stats = [
                'bills_processed' => $billsProcessed,
                'approval_rate' => $billsProcessed > 0 ? round(($approved / $billsProcessed) * 100, 1) : 0,
                'avg_processing_time' => 0, // Calculate based on claim processing time
                'rating' => 4.5, // Default rating
            ];
        } catch (\Exception $e) {}

        return view('service-provider.performance.index', compact('stats'));
    }
}
