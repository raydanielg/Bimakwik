<?php

namespace App\Http\Controllers\Bancassurance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ComplianceController extends Controller
{
    public function index()
    {
        return view('bancassurance.compliance.index');
    }
    
    public function reports()
    {
        return view('bancassurance.reports.index');
    }
    
    public function storeCheck(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'check_item' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'due_date' => 'required|date',
            'assigned_to' => 'required|string|max:255',
            'description' => 'nullable|string',
        ], [
            'check_item.required' => 'Check item is required',
            'category.required' => 'Category is required',
            'due_date.required' => 'Due date is required',
            'due_date.date' => 'Due date must be a valid date',
            'assigned_to.required' => 'Assigned to is required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Create check (demo - in real app, save to database)
            $check = [
                'id' => rand(1000, 9999),
                'check_item' => $request->check_item,
                'category' => $request->category,
                'due_date' => $request->due_date,
                'assigned_to' => $request->assigned_to,
                'description' => $request->description,
                'status' => 'Pending',
                'created_at' => now()->format('Y-m-d H:i:s'),
            ];

            return response()->json([
                'success' => true,
                'message' => 'Check added successfully',
                'data' => $check
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while adding check',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    public function showCheck($id)
    {
        try {
            // Get check details (demo - in real app, fetch from database)
            $check = [
                'id' => $id,
                'check_item' => 'AML/KYC Verification',
                'category' => 'Regulatory',
                'due_date' => '2024-05-25',
                'assigned_to' => 'John Doe',
                'description' => 'Complete AML/KYC verification for all new customers and ensure compliance with regulatory requirements.',
                'status' => 'Completed',
                'created_at' => now()->subDay()->format('Y-m-d H:i:s'),
                'evidence' => [
                    'Document 1: Customer KYC Forms',
                    'Document 2: AML Screening Results',
                    'Document 3: Compliance Certificate',
                ],
            ];
            
            return response()->json([
                'success' => true,
                'data' => $check
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch check details',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    public function updateCheck(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:Pending,In Progress,Completed',
        ], [
            'status.required' => 'Status is required',
            'status.in' => 'Status must be Pending, In Progress, or Completed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Update check (demo - in real app, update in database)
            $check = [
                'id' => $id,
                'status' => $request->status,
                'updated_at' => now()->format('Y-m-d H:i:s'),
            ];

            return response()->json([
                'success' => true,
                'message' => 'Check updated successfully',
                'data' => $check
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating check',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    public function generateReport(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'report_type' => 'required|string|max:255',
            'period' => 'required|string|max:255',
            'description' => 'nullable|string',
        ], [
            'report_type.required' => 'Report type is required',
            'period.required' => 'Period is required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Generate report (demo - in real app, generate actual report)
            $report = [
                'id' => 'RPT-' . date('Y') . '-' . str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT),
                'report_type' => $request->report_type,
                'period' => $request->period,
                'description' => $request->description,
                'generated_by' => auth()->user()->name ?? 'System',
                'status' => 'Pending',
                'created_at' => now()->format('Y-m-d H:i:s'),
            ];

            return response()->json([
                'success' => true,
                'message' => 'Report generated successfully',
                'data' => $report
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while generating report',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    public function showReport($id)
    {
        try {
            // Get report details (demo - in real app, fetch from database)
            $report = [
                'id' => $id,
                'report_type' => 'Monthly Sales Report',
                'period' => 'May 2024',
                'description' => 'Comprehensive monthly sales report including all bancassurance products sold during the period.',
                'generated_by' => 'John Doe',
                'status' => 'Approved',
                'created_at' => now()->format('Y-m-d H:i:s'),
                'data' => [
                    'total_sales' => 156,
                    'total_premium' => 'TZS 45.8M',
                    'total_commission' => 'TZS 4.58M',
                    'active_policies' => 142,
                    'pending_policies' => 14,
                ],
            ];
            
            return response()->json([
                'success' => true,
                'data' => $report
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch report details',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    public function downloadReport($id)
    {
        try {
            // Download report (demo - in real app, generate PDF)
            
            return response()->json([
                'success' => true,
                'message' => 'Report downloaded successfully',
                'data' => [
                    'file_name' => "report_{$id}_" . now()->format('Y-m-d_H-i-s') . '.pdf',
                    'download_url' => "#"
                ]
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to download report',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
