<?php

namespace App\Http\Controllers\Sfe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\CustomerPolicy;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PolicyController extends Controller
{
    public function index()
    {
        $customerId = Customer::where('user_id', Auth::id())->value('id');
        $policies = $customerId
            ? CustomerPolicy::where('customer_id', $customerId)->latest()->take(10)->get()
            : collect();

        return view('sfe.policies.index', [
            'policies' => $policies,
            'activePolicies' => $policies->where('status', 'active')->count(),
            'totalPremiums' => $policies->sum('premium_amount'),
        ]);
    }

    public function create()
    {
        return view('sfe.policies.create', [
            'products' => Product::where('is_active', true)->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'coverage' => 'required|string',
            'premium_amount' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'company_code' => 'nullable|string|max:50',
            'sale_point_code' => 'nullable|string|max:50',
        ]);

        $customer = Customer::firstOrCreate(
            ['user_id' => Auth::id()],
            ['name' => Auth::user()->name, 'email' => Auth::user()->email]
        );

        $product = Product::findOrFail($validated['product_id']);

        $policy = CustomerPolicy::create([
            'customer_id' => $customer->id,
            'policy_number' => 'POL-' . strtoupper(Str::random(8)),
            'product_id' => $product->id,
            'product_name' => $product->product_name,
            'premium_amount' => $validated['premium_amount'],
            'coverage_level' => $validated['coverage'],
            'insurer_id' => $product->insurer_id,
            'agent_id' => Auth::user()->agent?->id,
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'status' => 'active',
            'company_code' => $validated['company_code'] ?? null,
            'sale_point_code' => $validated['sale_point_code'] ?? null,
        ]);

        return redirect()->route('sfe.policies.index')
            ->with('success', 'Policy created successfully.');
    }
}
