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
        ->middleware('auth');
    }

    /**
     * Redirect user to their specific dashboard based on role.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index()
    {
         = Auth::user();

        // High-level priority checks
        if (\->hasRole('super_admin') || \->hasRole('admin') || \->hasRole('sub_admin')) {
            return redirect()->route('admin.dashboard');
        } 
        
        if (\->hasRole('insurer')) {
            return redirect()->route('insurer.dashboard');
        } 
        
        if (\->hasRole('broker')) {
            return redirect()->route('broker.dashboard');
        } 
        
        if (\->hasRole('aggregator')) {
            return redirect()->route('aggregator.dashboard');
        } 
        
        if (\->hasRole('agent') || \->hasRole('sfe') || \->hasRole('bancassurance')) {
            return redirect()->route('agent.dashboard');
        } 
        
        if (\->hasRole('service_provider')) {
            return redirect()->route('service-provider.dashboard');
        } 
        
        if (\->hasRole('regulator')) {
            return redirect()->route('regulator.dashboard');
        } 
        
        if (\->hasRole('financing_partner')) {
            return redirect()->route('financing-partner.dashboard');
        } 
        
        if (\->hasRole('developer')) {
            return redirect()->route('developer.dashboard');
        } 
        
        if (\->hasRole('customer')) {
            return redirect()->route('customer.dashboard');
        }

        // Final fallback if no roles match
        abort(403, 'Unauthorized. Please contact system administrator.');
    }
}
