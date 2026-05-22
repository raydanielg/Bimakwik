<?php

namespace App\Http\Controllers\Bancassurance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PolicyController extends Controller
{
    public function index()
    {
        return view('bancassurance.policies.index');
    }
    
    public function sales()
    {
        return view('bancassurance.sales.index');
    }
    
    public function mySales()
    {
        return view('bancassurance.my-sales.index');
    }
    
    public function storeSale(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
            'product' => 'required|string|max:255',
            'premium' => 'required|numeric|min:0',
            'branch' => 'required|string|max:255',
            'sold_by' => 'required|string|max:255',
            'policy_start_date' => 'required|date',
            'policy_end_date' => 'required|date|after:policy_start_date',
        ], [
            'customer_name.required' => 'Customer name is required',
            'customer_email.required' => 'Customer email is required',
            'customer_email.email' => 'Email must be valid',
            'customer_phone.required' => 'Customer phone is required',
            'product.required' => 'Product is required',
            'premium.required' => 'Premium amount is required',
            'premium.numeric' => 'Premium must be a number',
            'branch.required' => 'Branch is required',
            'sold_by.required' => 'Sold by is required',
            'policy_start_date.required' => 'Policy start date is required',
            'policy_end_date.required' => 'Policy end date is required',
            'policy_end_date.after' => 'Policy end date must be after start date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Create sale (demo - in real app, save to database)
            $policyNumber = 'POL-' . date('Y') . '-' . str_pad(rand(1, 999999), 6, '0', STR_PAD_LEFT);
            
            $sale = [
                'id' => rand(1000, 9999),
                'policy_number' => $policyNumber,
                'customer_name' => $request->customer_name,
                'customer_email' => $request->customer_email,
                'customer_phone' => $request->customer_phone,
                'product' => $request->product,
                'premium' => $request->premium,
                'branch' => $request->branch,
                'sold_by' => $request->sold_by,
                'policy_start_date' => $request->policy_start_date,
                'policy_end_date' => $request->policy_end_date,
                'status' => 'Pending',
                'created_at' => now(),
            ];

            return response()->json([
                'success' => true,
                'message' => 'Sale recorded successfully',
                'data' => $sale
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while recording sale',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    public function showSale($id)
    {
        try {
            // Get sale details (demo - in real app, fetch from database)
            $sale = [
                'id' => $id,
                'policy_number' => 'POL-2024-001234',
                'customer_name' => 'Hamis Juma',
                'customer_email' => 'hamis@email.com',
                'customer_phone' => '+255 712 345 678',
                'product' => 'Motor Insurance',
                'premium' => 450000,
                'branch' => 'Branch A',
                'sold_by' => 'John Doe',
                'policy_start_date' => now()->format('Y-m-d'),
                'policy_end_date' => now()->addYear()->format('Y-m-d'),
                'status' => 'Active',
                'created_at' => now()->subDay()->format('Y-m-d H:i:s'),
                'notes' => 'Comprehensive motor insurance coverage for Toyota Corolla.',
            ];
            
            return response()->json([
                'success' => true,
                'data' => $sale
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch sale details',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    public function exportSales(Request $request)
    {
        try {
            // Export sales to PDF (demo - in real app, generate actual PDF)
            sleep(1);
            
            return response()->json([
                'success' => true,
                'message' => 'Sales exported successfully',
                'data' => [
                    'file_name' => 'sales_export_' . now()->format('Y-m-d_H-i-s') . '.pdf',
                    'total_sales' => 156,
                    'total_amount' => 'TZS 45.8M',
                    'exported_at' => now()->format('Y-m-d H:i:s'),
                ]
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Export failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    public function updateSale(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
            'product' => 'required|string|max:255',
            'premium' => 'required|numeric|min:0',
            'branch' => 'required|string|max:255',
            'sold_by' => 'required|string|max:255',
            'policy_start_date' => 'required|date',
            'policy_end_date' => 'required|date|after:policy_start_date',
        ], [
            'customer_name.required' => 'Customer name is required',
            'customer_email.required' => 'Customer email is required',
            'customer_email.email' => 'Email must be valid',
            'customer_phone.required' => 'Customer phone is required',
            'product.required' => 'Product is required',
            'premium.required' => 'Premium amount is required',
            'premium.numeric' => 'Premium must be a number',
            'branch.required' => 'Branch is required',
            'sold_by.required' => 'Sold by is required',
            'policy_start_date.required' => 'Policy start date is required',
            'policy_end_date.required' => 'Policy end date is required',
            'policy_end_date.after' => 'Policy end date must be after start date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Update sale (demo - in real app, update in database)
            $sale = [
                'id' => $id,
                'customer_name' => $request->customer_name,
                'customer_email' => $request->customer_email,
                'customer_phone' => $request->customer_phone,
                'product' => $request->product,
                'premium' => $request->premium,
                'branch' => $request->branch,
                'sold_by' => $request->sold_by,
                'policy_start_date' => $request->policy_start_date,
                'policy_end_date' => $request->policy_end_date,
                'updated_at' => now(),
            ];

            return response()->json([
                'success' => true,
                'message' => 'Sale updated successfully',
                'data' => $sale
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating sale',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
