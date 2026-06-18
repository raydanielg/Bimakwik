<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\TirAmisKycService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class TirAmisKycController extends Controller
{
    protected TirAmisKycService $kyc;

    public function __construct(TirAmisKycService $kyc)
    {
        $this->kyc = $kyc;
    }

    // ==================== DASHBOARD ====================

    public function index()
    {
        $health = $this->kyc->healthCheck();
        return view('admin.tiramis.kyc.index', compact('health'));
    }

    // ==================== NIDA VERIFICATION ====================

    public function verifyNidaForm()
    {
        return view('admin.tiramis.kyc.nida-verify');
    }

    public function verifyNida(Request $request)
    {
        $request->validate([
            'nida_number' => 'required|string|min:10|max:30',
        ]);

        $result = $this->kyc->verifyNida($request->nida_number);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json($result);
        }

        if ($result['success'] && $result['verified']) {
            return view('admin.tiramis.kyc.nida-result', [
                'result' => $result,
                'nida_number' => $request->nida_number,
            ]);
        }

        return back()->with('error', $result['error'] ?? 'Verification failed')->withInput();
    }

    // ==================== CUSTOMER LOOKUP ====================

    public function customerLookupForm()
    {
        return view('admin.tiramis.kyc.customer-lookup');
    }

    public function customerLookup(Request $request)
    {
        $request->validate([
            'identity_number' => 'required|string|min:5|max:50',
            'identity_type' => 'required|in:NIDA,PASSPORT,DRIVING_LICENSE,VOTER_ID,ZANID',
        ]);

        $result = $this->kyc->lookupCustomer($request->identity_number, $request->identity_type);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json($result);
        }

        if ($result['success']) {
            return view('admin.tiramis.kyc.customer-result', [
                'result' => $result,
                'identity_number' => $request->identity_number,
                'identity_type' => $request->identity_type,
            ]);
        }

        return back()->with('error', $result['error'] ?? 'Lookup failed')->withInput();
    }

    // ==================== VEHICLE LOOKUP ====================

    public function vehicleLookupForm()
    {
        return view('admin.tiramis.kyc.vehicle-lookup');
    }

    public function vehicleLookup(Request $request)
    {
        $request->validate([
            'registration_number' => 'required|string|min:3|max:20',
        ]);

        $result = $this->kyc->lookupVehicle(strtoupper($request->registration_number));

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json($result);
        }

        if ($result['success']) {
            return view('admin.tiramis.kyc.vehicle-result', [
                'result' => $result,
                'registration_number' => strtoupper($request->registration_number),
            ]);
        }

        return back()->with('error', $result['error'] ?? 'Vehicle lookup failed')->withInput();
    }

    public function vehicleVerify(Request $request)
    {
        $request->validate([
            'registration_number' => 'required|string|min:3|max:20',
            'chassis_number' => 'required|string|min:5|max:50',
        ]);

        $result = $this->kyc->verifyVehicle(
            strtoupper($request->registration_number),
            strtoupper($request->chassis_number)
        );

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json($result);
        }

        if ($result['success'] && $result['verified']) {
            return back()->with('success', 'Vehicle verified successfully.');
        }

        return back()->with('error', $result['error'] ?? 'Vehicle verification failed');
    }

    // ==================== HEALTH CHECK ====================

    public function health()
    {
        $health = $this->kyc->healthCheck();
        return response()->json($health);
    }

    // ==================== CACHE MANAGEMENT ====================

    public function clearCache(Request $request)
    {
        $request->validate([
            'prefix' => 'required|in:nida,vehicle,lookup,all',
        ]);

        $prefix = $request->prefix;
        if ($prefix === 'all') {
            Cache::flush();
            return back()->with('success', 'All TIRAMIS cache cleared.');
        }

        $keys = Cache::get('tiramis_cache_keys_' . $prefix, []);
        foreach ($keys as $key) {
            Cache::forget($key);
        }
        Cache::forget('tiramis_cache_keys_' . $prefix);

        return back()->with('success', "TIRAMIS {$prefix} cache cleared.");
    }
}
