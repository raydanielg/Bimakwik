<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Redirect user to their specific dashboard based on role.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        $user = Auth::user();

        // High-level priority checks
        if ($user->hasRole('super_admin') || $user->hasRole('admin') || $user->hasRole('sub_admin')) {
            return redirect()->route('admin.dashboard');
        } 
        
        if ($user->hasRole('insurer')) {
            return redirect()->route('insurer.dashboard');
        } 
        
        if ($user->hasRole('broker')) {
            return redirect()->route('broker.dashboard');
        } 
        
        if ($user->hasRole('aggregator')) {
            return redirect()->route('aggregator.dashboard');
        } 
        
        if ($user->hasRole('agent')) {
            return redirect()->route('agent.dashboard');
        }

        if ($user->hasRole('sfe')) {
            return redirect()->route('sfe.dashboard');
        }

        if ($user->hasRole('bancassurance')) {
            return redirect()->route('agent.dashboard'); // Temporarily reuse agent dashboard or create new if needed
        } 
        
        if ($user->hasRole('service_provider')) {
            return redirect()->route('service-provider.dashboard');
        } 
        
        if ($user->hasRole('regulator')) {
            return redirect()->route('regulator.dashboard');
        } 
        
        if ($user->hasRole('financing_partner')) {
            return redirect()->route('financing-partner.dashboard');
        } 
        
        if ($user->hasRole('developer')) {
            return redirect()->route('developer.dashboard');
        } 
        
        if ($user->hasRole('customer')) {
            return redirect()->route('customer.dashboard');
        }

        // Final fallback if no roles match
        abort(403, 'Unauthorized. Please contact system administrator.');
    }
}

