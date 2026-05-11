<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected function redirectTo()
    {
        $user = auth()->user();
        
        if ($user->hasRole('super_admin') || $user->hasRole('admin') || $user->hasRole('sub_admin')) {
            return route('admin.dashboard');
        }
        
        if ($user->hasRole('insurer')) {
            return route('insurer.dashboard');
        }

        if ($user->hasRole('broker')) {
            return route('broker.dashboard');
        }

        if ($user->hasRole('aggregator')) {
            return route('aggregator.dashboard');
        }

        if ($user->hasRole('agent') || $user->hasRole('sfe') || $user->hasRole('bancassurance')) {
            return route('agent.dashboard');
        }

        if ($user->hasRole('service_provider')) {
            return route('service-provider.dashboard');
        }

        if ($user->hasRole('financing_partner')) {
            return route('financing-partner.dashboard');
        }

        if ($user->hasRole('developer')) {
            return route('developer.dashboard');
        }

        if ($user->hasRole('regulator')) {
            return route('regulator.dashboard');
        }

        if ($user->hasRole('customer')) {
            return route('customer.dashboard');
        }

        return route('dashboard');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
