<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserManagementController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|exists:roles,id',
            'phone' => 'nullable|string|max:20',
            'status' => 'required|in:active,inactive,suspended',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'status' => $request->status,
        ]);

        $user->roles()->attach($request->role);

        return redirect()->route('admin.users.index')
            ->with('success', 'User created successfully');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'role' => 'required|exists:roles,id',
            'phone' => 'nullable|string|max:20',
            'status' => 'required|in:active,inactive,suspended',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'status' => $request->status,
        ]);

        if ($request->filled('password')) {
            $request->validate(['password' => 'required|string|min:8|confirmed']);
            $user->update(['password' => Hash::make($request->password)]);
        }

        $user->roles()->sync([$request->role]);

        return redirect()->route('admin.users.index')
            ->with('success', 'User updated successfully');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')
            ->with('success', 'User deleted successfully');
    }

    // Aggregator specific methods
    public function aggregators()
    {
        $aggregators = User::role('aggregator')->with('aggregatorProfile')->paginate(20);
        return view('admin.users.aggregators', compact('aggregators'));
    }

    public function createAggregator()
    {
        return view('admin.users.create-aggregator');
    }

    public function storeAggregator(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'required|string|max:20',
            'business_license' => 'required|string|max:255',
            'physical_address' => 'required|string|max:500',
            'website' => 'nullable|url|max:255',
            'commission_rate' => 'required|numeric|min:0|max:100',
        ]);

        $user = User::create([
            'name' => $request->contact_person,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'status' => 'active',
        ]);

        $aggregatorRole = Role::where('name', 'aggregator')->first();
        $user->roles()->attach($aggregatorRole);

        // Create aggregator profile
        $user->aggregatorProfile()->create([
            'company_name' => $request->company_name,
            'business_license' => $request->business_license,
            'physical_address' => $request->physical_address,
            'website' => $request->website,
            'commission_rate' => $request->commission_rate,
            'is_approved' => true,
        ]);

        return redirect()->route('admin.users.aggregators')
            ->with('success', 'Aggregator created successfully');
    }

    // Other user type methods
    public function admins()
    {
        $admins = User::role(['super_admin', 'admin', 'sub_admin'])->paginate(20);
        $superAdminCount = User::role('super_admin')->count();
        $adminCount = User::role('admin')->count();
        $subAdminCount = User::role('sub_admin')->count();
        return view('admin.users.admins', compact('admins', 'superAdminCount', 'adminCount', 'subAdminCount'));
    }

    public function insurers()
    {
        $insurers = User::role('insurer')->paginate(20);
        return view('admin.users.insurers', compact('insurers'));
    }

    public function brokers()
    {
        $brokers = User::role('broker')->with('brokerProfile')->paginate(20);
        return view('admin.users.brokers', compact('brokers'));
    }

    public function agents()
    {
        $agents = User::role(['sfe', 'bancassurance'])->with('agentProfile')->paginate(20);
        $bancassuranceCount = User::role('bancassurance')->count();
        $sfeCount = User::role('sfe')->count();
        return view('admin.users.agents', compact('agents', 'bancassuranceCount', 'sfeCount'));
    }

    public function customers()
    {
        $customers = User::role('customer')->with('customerProfile')->paginate(20);
        // Count verified customers by checking the customer record's kyc_status
        $verifiedCustomerCount = User::role('customer')
            ->whereHas('customer', function($q) { $q->where('kyc_status', 'verified'); })
            ->count();
        return view('admin.users.customers', compact('customers', 'verifiedCustomerCount'));
    }

    public function serviceProviders()
    {
        $providers = User::role('service_provider')->with('providerProfile')->paginate(20);
        // Count providers by service type - need to check service_provider_types table
        $hospitalCount = User::role('service_provider')
            ->whereHas('serviceProvider', function($q) { 
                $q->whereHas('serviceProviderType', function($q2) { 
                    $q2->where('type_code', 'hospital');
                });
            })
            ->count();
        $garageCount = User::role('service_provider')
            ->whereHas('serviceProvider', function($q) { 
                $q->whereHas('serviceProviderType', function($q2) { 
                    $q2->where('type_code', 'garage');
                });
            })
            ->count();
        return view('admin.users.service-providers', compact('providers', 'hospitalCount', 'garageCount'));
    }

    public function rbacSettings()
    {
        $roles = Role::with('permissions')->get();
        return view('admin.users.rbac', compact('roles'));
    }
}
