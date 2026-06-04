<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\InsuranceProduct;
use Illuminate\Http\Request;

class InsuranceProductController extends Controller
{
    public function index()
    {
        $products = InsuranceProduct::where('is_active', true)
            ->with(['policyCategory', 'insurer'])
            ->paginate(10);
        $categories = \App\Models\PolicyCategory::all();
        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = \App\Models\PolicyCategory::all();
        $insurers = \App\Models\User::role('insurer')->get();
        $currencies = ['TZS', 'USD', 'EUR', 'GBP', 'KES', 'UGX'];
        return view('admin.products.create', compact('categories', 'insurers', 'currencies'));
    }

    public function builder()
    {
        $categories = \App\Models\PolicyCategory::all();
        $insurers = \App\Models\User::role('insurer')->get();
        $currencies = ['TZS', 'USD', 'EUR', 'GBP', 'KES', 'UGX'];
        return view('admin.products.builder', compact('categories', 'insurers', 'currencies'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'policy_category_id' => 'required|exists:policy_categories,id',
            'insurer_id' => 'required|exists:users,id',
            'premium' => 'required|numeric|min:0',
            'min_age' => 'required|integer|min:0',
            'max_age' => 'required|integer|min:0',
            'benefits' => 'required|array',
            'exclusions' => 'nullable|array'
        ]);

        $product = InsuranceProduct::create($validated);
        return redirect()->route('admin.products.show', $product)->with('success', 'Product created successfully');
    }

    public function show(InsuranceProduct $product)
    {
        $product->load(['policyCategory', 'insurer']);
        return view('admin.products.show', compact('product'));
    }

    public function edit(InsuranceProduct $product)
    {
        $categories = \App\Models\PolicyCategory::all();
        $insurers = \App\Models\User::role('insurer')->get();
        $currencies = ['TZS', 'USD', 'EUR', 'GBP', 'KES', 'UGX'];
        return view('admin.products.edit', compact('product', 'categories', 'insurers', 'currencies'));
    }

    public function update(Request $request, InsuranceProduct $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'policy_category_id' => 'required|exists:policy_categories,id',
            'insurer_id' => 'required|exists:users,id',
            'premium' => 'required|numeric|min:0',
            'min_age' => 'required|integer|min:0',
            'max_age' => 'required|integer|min:0',
            'benefits' => 'required|array',
            'exclusions' => 'nullable|array'
        ]);

        $product->update($validated);
        return redirect()->route('admin.products.show', $product)->with('success', 'Product updated successfully');
    }

    public function destroy(InsuranceProduct $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully');
    }

    public function compare(Request $request)
    {
        $query = InsuranceProduct::where('is_active', true)
            ->with(['policyCategory', 'insurer.roles']);

        if ($request->has('category') && $request->category) {
            $query->where('policy_category_id', $request->category);
        }

        $products = $query->get();
        $categories = \App\Models\PolicyCategory::all();

        return view('admin.products.compare', compact('products', 'categories'));
    }
}
