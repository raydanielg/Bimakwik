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
