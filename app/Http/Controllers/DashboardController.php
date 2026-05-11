<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Redirect user to their specific dashboard based on role.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        $user = auth()->user();

        if ($user->hasRole('super_admin') || $user->hasRole('admin') || $user->hasRole('sub_admin')) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->hasRole('insurer')) {
            return redirect()->route('insurer.dashboard');
        } elseif ($user->hasRole('broker')) {
            return redirect()->route('broker.dashboard');
        } elseif ($user->hasRole('aggregator')) {
            return redirect()->route('aggregator.dashboard');
        } elseif ($user->hasRole('agent') || $user->hasRole('sfe') || $user->hasRole('bancassurance')) {
            return redirect()->route('agent.dashboard');
        } elseif ($user->hasRole('service_provider')) {
            return redirect()->route('service-provider.dashboard');
        } elseif ($user->hasRole('regulator')) {
            return redirect()->route('regulator.dashboard');
        } elseif ($user->hasRole('financing_partner')) {
            return redirect()->route('financing-partner.dashboard');
        } elseif ($user->hasRole('developer')) {
            return redirect()->route('developer.dashboard');
        } elseif ($user->hasRole('customer')) {
            return redirect()->route('customer.dashboard');
        }

        abort(403, 'User role not recognized.');
    }
}
