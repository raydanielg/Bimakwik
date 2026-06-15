<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CommissionRate;
use App\Models\InsuranceProduct;
use App\Models\PolicyCategory;
use App\Models\Insurer;
use Illuminate\Http\Request;

class CommissionRateController extends Controller
{
    public function index()
    {
        $rates = CommissionRate::with(['product', 'category', 'insurer'])
            ->latest()
            ->paginate(50);

        $categories = PolicyCategory::where('is_active', true)->orderBy('category_name')->get();
        $products = InsuranceProduct::where('is_active', true)->orderBy('product_name')->get();
        $insurers = Insurer::where('is_active', true)->orderBy('insurer_name')->get();

        return view('admin.commissions.index', compact('rates', 'categories', 'products', 'insurers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'insurer_id' => 'nullable|exists:insurers,id',
            'insurance_product_id' => 'nullable|exists:insurance_products,id',
            'policy_category_id' => 'nullable|exists:policy_categories,id',
            'channel_type' => 'required|string|max:50',
            'rate_type' => 'required|in:percentage,fixed',
            'rate_value' => 'required|numeric|min:0|max:999.9999',
            'min_premium_amount' => 'nullable|numeric|min:0',
            'max_premium_amount' => 'nullable|numeric|min:0',
            'effective_from' => 'nullable|date',
            'effective_to' => 'nullable|date|after_or_equal:effective_from',
        ]);

        $validated['created_by'] = auth()->id();

        CommissionRate::create($validated);

        return redirect()->route('admin.commissions.index')
            ->with('success', 'Commission rate created successfully.');
    }

    public function update(Request $request, CommissionRate $commission)
    {
        $validated = $request->validate([
            'insurer_id' => 'nullable|exists:insurers,id',
            'insurance_product_id' => 'nullable|exists:insurance_products,id',
            'policy_category_id' => 'nullable|exists:policy_categories,id',
            'channel_type' => 'required|string|max:50',
            'rate_type' => 'required|in:percentage,fixed',
            'rate_value' => 'required|numeric|min:0|max:999.9999',
            'min_premium_amount' => 'nullable|numeric|min:0',
            'max_premium_amount' => 'nullable|numeric|min:0',
            'effective_from' => 'nullable|date',
            'effective_to' => 'nullable|date|after_or_equal:effective_from',
            'is_active' => 'boolean',
        ]);

        $commission->update($validated);

        return redirect()->route('admin.commissions.index')
            ->with('success', 'Commission rate updated successfully.');
    }

    public function destroy(CommissionRate $commission)
    {
        $commission->delete();

        return redirect()->route('admin.commissions.index')
            ->with('success', 'Commission rate deleted.');
    }

    public function toggle(CommissionRate $commission)
    {
        $commission->update(['is_active' => !$commission->is_active]);

        return back()->with('success', 'Commission rate ' . ($commission->is_active ? 'activated' : 'deactivated') . '.');
    }
}
