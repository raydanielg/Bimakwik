<?php

namespace App\Http\Controllers\Bancassurance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        return view('bancassurance.products.index');
    }
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string|max:255',
            'min_premium' => 'required|numeric|min:0',
            'commission_rate' => 'required|numeric|min:0|max:100',
            'status' => 'required|in:active,inactive',
        ], [
            'name.required' => 'Product name is required',
            'description.required' => 'Description is required',
            'category.required' => 'Category is required',
            'min_premium.required' => 'Minimum premium is required',
            'min_premium.numeric' => 'Minimum premium must be a number',
            'commission_rate.required' => 'Commission rate is required',
            'commission_rate.numeric' => 'Commission rate must be a number',
            'commission_rate.max' => 'Commission rate cannot exceed 100',
            'status.required' => 'Status is required',
            'status.in' => 'Status must be active or inactive',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Create product (demo - in real app, save to database)
            $product = [
                'id' => rand(1000, 9999),
                'name' => $request->name,
                'description' => $request->description,
                'category' => $request->category,
                'min_premium' => $request->min_premium,
                'commission_rate' => $request->commission_rate,
                'status' => $request->status,
                'created_at' => now(),
            ];

            return response()->json([
                'success' => true,
                'message' => 'Product added successfully',
                'data' => $product
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while adding product',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    public function show($id)
    {
        try {
            // Get product details (demo - in real app, fetch from database)
            $product = [
                'id' => $id,
                'name' => 'Motor Insurance',
                'description' => 'Comprehensive motor insurance for bank customers with coverage for accidents, theft, and third-party liability.',
                'category' => 'Motor',
                'min_premium' => 150000,
                'commission_rate' => 10,
                'status' => 'active',
                'created_at' => now()->subDay()->format('Y-m-d H:i:s'),
                'features' => [
                    'Accident coverage',
                    'Theft protection',
                    'Third-party liability',
                    '24/7 roadside assistance',
                ],
            ];
            
            return response()->json([
                'success' => true,
                'data' => $product
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch product details',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string|max:255',
            'min_premium' => 'required|numeric|min:0',
            'commission_rate' => 'required|numeric|min:0|max:100',
            'status' => 'required|in:active,inactive',
        ], [
            'name.required' => 'Product name is required',
            'description.required' => 'Description is required',
            'category.required' => 'Category is required',
            'min_premium.required' => 'Minimum premium is required',
            'min_premium.numeric' => 'Minimum premium must be a number',
            'commission_rate.required' => 'Commission rate is required',
            'commission_rate.numeric' => 'Commission rate must be a number',
            'commission_rate.max' => 'Commission rate cannot exceed 100',
            'status.required' => 'Status is required',
            'status.in' => 'Status must be active or inactive',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Update product (demo - in real app, update in database)
            $product = [
                'id' => $id,
                'name' => $request->name,
                'description' => $request->description,
                'category' => $request->category,
                'min_premium' => $request->min_premium,
                'commission_rate' => $request->commission_rate,
                'status' => $request->status,
                'updated_at' => now(),
            ];

            return response()->json([
                'success' => true,
                'message' => 'Product updated successfully',
                'data' => $product
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating product',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    public function destroy($id)
    {
        try {
            // Delete product (demo - in real app, delete from database)
            
            return response()->json([
                'success' => true,
                'message' => 'Product deleted successfully'
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete product',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
