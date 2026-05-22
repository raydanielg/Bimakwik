<?php

namespace App\Http\Controllers\Bancassurance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BankIntegrationController extends Controller
{
    public function index()
    {
        return view('bancassurance.integration.index');
    }
    
    public function store(Request $request)
    {
        // Strong validation
        $validator = Validator::make($request->all(), [
            'bank_name' => 'required|string|max:255',
            'bank_country' => 'required|string|in:Tanzania,Kenya,Uganda,Rwanda',
            'integration_type' => 'required|string|in:API Integration,SFTP Integration,Webhook Integration',
            'api_endpoint' => 'nullable|url|max:500',
            'api_key' => 'nullable|string|max:255',
            'api_secret' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
            'test_connection' => 'boolean',
        ], [
            'bank_name.required' => 'Bank name is required',
            'bank_name.max' => 'Bank name must not exceed 255 characters',
            'bank_country.required' => 'Country is required',
            'bank_country.in' => 'Invalid country selected',
            'integration_type.required' => 'Integration type is required',
            'integration_type.in' => 'Invalid integration type',
            'api_endpoint.url' => 'API endpoint must be a valid URL',
            'api_endpoint.max' => 'API endpoint must not exceed 500 characters',
            'api_key.max' => 'API key must not exceed 255 characters',
            'api_secret.max' => 'API secret must not exceed 255 characters',
            'description.max' => 'Description must not exceed 1000 characters',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Create bank integration (demo - in real app, save to database)
            $integration = [
                'id' => rand(1000, 9999),
                'bank_name' => $request->bank_name,
                'bank_country' => $request->bank_country,
                'integration_type' => $request->integration_type,
                'api_endpoint' => $request->api_endpoint,
                'api_key' => $request->api_key,
                'api_secret' => $request->api_secret,
                'description' => $request->description,
                'status' => 'Pending',
                'last_sync' => 'Never',
                'created_at' => now(),
            ];

            // Test connection if requested
            if ($request->test_connection) {
                // Simulate connection test
                sleep(1);
                $integration['connection_test'] = 'passed';
            }

            return response()->json([
                'success' => true,
                'message' => 'Bank integration added successfully',
                'data' => $integration
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while saving the integration',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    public function sync($id)
    {
        try {
            // Simulate sync process
            sleep(1);
            
            return response()->json([
                'success' => true,
                'message' => 'Bank data synced successfully',
                'data' => [
                    'last_sync' => now()->format('H:i A'),
                    'records_synced' => rand(10, 100)
                ]
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Sync failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
