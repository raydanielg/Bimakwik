<?php

namespace App\Http\Controllers\ServiceProvider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ServiceProviderServiceLevelAgreement;

class AgreementController extends Controller
{
    public function index()
    {
        $agreements = collect();
        $stats = [
            'total' => 0,
            'active' => 0,
            'expiring_soon' => 0,
            'expired' => 0,
        ];

        try {
            $agreements = ServiceProviderServiceLevelAgreement::where('service_provider_id', auth()->id())
                ->latest()
                ->paginate(15);
            
            $stats = [
                'total' => ServiceProviderServiceLevelAgreement::where('service_provider_id', auth()->id())->count() ?? 0,
                'active' => ServiceProviderServiceLevelAgreement::where('service_provider_id', auth()->id())
                    ->where('status', 'active')->count() ?? 0,
                'expiring_soon' => ServiceProviderServiceLevelAgreement::where('service_provider_id', auth()->id())
                    ->where('end_date', '>', now())
                    ->where('end_date', '<=', now()->addDays(30))
                    ->count() ?? 0,
                'expired' => ServiceProviderServiceLevelAgreement::where('service_provider_id', auth()->id())
                    ->where('end_date', '<', now())
                    ->count() ?? 0,
            ];
        } catch (\Exception $e) {}

        return view('service-provider.agreements.index', compact('agreements', 'stats'));
    }

    public function show($id)
    {
        $agreement = null;
        try {
            $agreement = ServiceProviderServiceLevelAgreement::where('service_provider_id', auth()->id())
                ->findOrFail($id);
        } catch (\Exception $e) {}
        return view('service-provider.agreements.show', compact('agreement'));
    }
}
