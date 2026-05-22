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
    
    public function updateStatus(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:active,disabled',
        ], [
            'status.required' => 'Status is required',
            'status.in' => 'Invalid status value',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Update status (demo - in real app, update database)
            $status = $request->status;
            
            return response()->json([
                'success' => true,
                'message' => "Bank integration status updated to {$status}",
                'data' => [
                    'id' => $id,
                    'status' => $status,
                    'updated_at' => now()
                ]
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating status',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    public function getSettings($id)
    {
        try {
            // Get bank integration settings (demo)
            $settings = [
                'id' => $id,
                'bank_name' => $id == 1 ? 'CRDB Bank' : ($id == 2 ? 'NMB Bank' : 'NBC Bank'),
                'status' => 'active',
                'auto_sync' => true,
                'sync_interval' => '5',
                'api_timeout' => '30',
                'retry_attempts' => '3',
                'notification_enabled' => true,
                'log_level' => 'info',
            ];
            
            return response()->json([
                'success' => true,
                'data' => $settings
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch settings',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    public function updateSettings(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'auto_sync' => 'boolean',
            'sync_interval' => 'integer|min:1|max:60',
            'api_timeout' => 'integer|min:5|max:120',
            'retry_attempts' => 'integer|min:1|max:10',
            'notification_enabled' => 'boolean',
            'log_level' => 'string|in:debug,info,warning,error',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Update settings (demo - in real app, update database)
            return response()->json([
                'success' => true,
                'message' => 'Settings updated successfully',
                'data' => [
                    'id' => $id,
                    'updated_at' => now()
                ]
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating settings',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    public function setup(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'api_endpoint' => 'required|url|max:500',
            'api_key' => 'required|string|max:255',
            'api_secret' => 'required|string|max:255',
            'database_host' => 'required|string|max:255',
            'database_port' => 'required|integer|min:1|max:65535',
            'database_name' => 'required|string|max:255',
            'database_user' => 'required|string|max:255',
            'database_password' => 'required|string|max:255',
        ], [
            'api_endpoint.required' => 'API endpoint is required',
            'api_endpoint.url' => 'API endpoint must be a valid URL',
            'api_key.required' => 'API key is required',
            'api_secret.required' => 'API secret is required',
            'database_host.required' => 'Database host is required',
            'database_port.required' => 'Database port is required',
            'database_name.required' => 'Database name is required',
            'database_user.required' => 'Database user is required',
            'database_password.required' => 'Database password is required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Test database connection (demo - in real app, actual connection test)
            sleep(1);
            
            // Save setup configuration (demo - in real app, save to database)
            $setup = [
                'id' => $id,
                'api_endpoint' => $request->api_endpoint,
                'api_key' => $request->api_key,
                'api_secret' => $request->api_secret,
                'database_host' => $request->database_host,
                'database_port' => $request->database_port,
                'database_name' => $request->database_name,
                'database_user' => $request->database_user,
                'status' => 'active',
                'setup_completed' => true,
                'setup_date' => now(),
            ];
            
            return response()->json([
                'success' => true,
                'message' => 'Bank integration setup completed successfully',
                'data' => $setup
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Setup failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    public function testConnection(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'database_host' => 'required|string|max:255',
            'database_port' => 'required|integer|min:1|max:65535',
            'database_name' => 'required|string|max:255',
            'database_user' => 'required|string|max:255',
            'database_password' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Test database connection (demo - in real app, actual connection test)
            sleep(1);
            
            // Simulate successful connection
            return response()->json([
                'success' => true,
                'message' => 'Database connection successful',
                'data' => [
                    'connection_time' => '0.05s',
                    'database_version' => 'MySQL 8.0',
                    'status' => 'connected'
                ]
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Database connection failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
