<?php

namespace App\Http\Controllers\Bancassurance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function index()
    {
        return view('bancassurance.customers.index');
    }
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'bank_account' => 'required|string|max:50',
            'bank_name' => 'required|string|max:255',
            'interest' => 'required|string|max:255',
            'referred_by' => 'required|string|max:255',
        ], [
            'first_name.required' => 'First name is required',
            'last_name.required' => 'Last name is required',
            'email.required' => 'Email is required',
            'email.email' => 'Email must be valid',
            'phone.required' => 'Phone number is required',
            'bank_account.required' => 'Bank account is required',
            'bank_name.required' => 'Bank name is required',
            'interest.required' => 'Insurance interest is required',
            'referred_by.required' => 'Referred by is required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Create customer (demo - in real app, save to database)
            $customer = [
                'id' => rand(1000, 9999),
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'bank_account' => $request->bank_account,
                'bank_name' => $request->bank_name,
                'interest' => $request->interest,
                'referred_by' => $request->referred_by,
                'status' => 'Pending',
                'created_at' => now(),
            ];

            return response()->json([
                'success' => true,
                'message' => 'Customer added successfully',
                'data' => $customer
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while adding customer',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    public function show($id)
    {
        try {
            // Get customer details (demo - in real app, fetch from database)
            $customer = [
                'id' => $id,
                'first_name' => 'Hamis',
                'last_name' => 'Juma',
                'email' => 'hamis@email.com',
                'phone' => '+255 712 345 678',
                'bank_account' => 'CRDB ...8821',
                'bank_name' => 'CRDB Bank',
                'interest' => 'Motor Insurance',
                'referred_by' => 'Branch A',
                'status' => 'Converted',
                'created_at' => now()->subDay()->format('Y-m-d H:i:s'),
                'notes' => 'Interested in comprehensive motor insurance coverage.',
            ];
            
            return response()->json([
                'success' => true,
                'data' => $customer
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch customer details',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    public function export(Request $request)
    {
        try {
            // Export customers to PDF (demo - in real app, generate actual PDF)
            sleep(1);
            
            return response()->json([
                'success' => true,
                'message' => 'Customers exported successfully',
                'data' => [
                    'file_name' => 'customers_export_' . now()->format('Y-m-d_H-i-s') . '.pdf',
                    'total_customers' => 1245,
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
}
