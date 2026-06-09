<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SystemSetting;
use App\Models\ApiKey;
use App\Models\DeveloperApiKey;
use App\Models\CountryConfig;
use App\Models\CountryInstance;
use App\Models\AuditLog;
use Illuminate\Pagination\LengthAwarePaginator;

class SystemTechController extends Controller
{
    public function configurations()
    {
        try {
            $configs = SystemSetting::all()->keyBy('key');
        } catch (\Exception $e) {
            $configs = collect();
        }
        return view('admin.system.configurations', compact('configs'));
    }

    public function saveConfigurations(Request $request)
    {
        try {
            $settings = $request->except('_token');
            foreach ($settings as $key => $value) {
                SystemSetting::updateOrCreate(
                    ['key' => $key],
                    ['value' => $value, 'updated_at' => now()]
                );
            }
            return response()->json([
                'success' => true,
                'message' => 'Settings saved successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to save: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function developerPortal()
    {
        $apiKeys = collect();
        $totalKeys = 0;
        $apiCallsToday = 0;
        $successRate = 0;
        $totalApps = 0;
        try {
            $apiKeys = DeveloperApiKey::latest()->limit(20)->get();
            $totalKeys = DeveloperApiKey::count();
            $totalApps = \App\Models\DeveloperApp::count();
            
            // API stats today
            if (class_exists(\App\Models\ApiLog::class)) {
                $apiCallsToday = \App\Models\ApiLog::whereDate('created_at', today())->count();
                $successCalls = \App\Models\ApiLog::whereDate('created_at', today())
                    ->where('status_code', '<', 400)->count();
                $successRate = $apiCallsToday > 0 ? round(($successCalls / $apiCallsToday) * 100, 1) : 100;
            }
        } catch (\Exception $e) {}
        return view('admin.system.developer-portal', compact(
            'apiKeys', 'totalKeys', 'apiCallsToday', 'successRate', 'totalApps'
        ));
    }

    public function multiCountry()
    {
        $countries = collect();
        $totalCountries = 0;
        $activeCountries = 0;
        try {
            $countries = CountryInstance::latest()->get();
            $totalCountries = $countries->count();
            $activeCountries = $countries->where('status', 'active')->count();
        } catch (\Exception $e) {}
        return view('admin.system.multi-country', compact(
            'countries', 'totalCountries', 'activeCountries'
        ));
    }
    
    public function auditLogs()
    {
        try {
            // Get all logs with user relationship
            $query = AuditLog::latest();
            
            // Apply filters if present
            if (request('action')) {
                $query->where('action', request('action'));
            }
            if (request('user')) {
                $query->where('user_id', request('user'));
            }
            if (request('search')) {
                $search = request('search');
                $query->where(function($q) use ($search) {
                    $q->where('action', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%")
                      ->orWhere('ip_address', 'like', "%{$search}%");
                });
            }
            
            $logs = $query->paginate(20);
            
            // Get statistics
            $totalLogs = AuditLog::count();
            $todayLogs = AuditLog::whereDate('created_at', today())->count();
            $uniqueUsers = AuditLog::distinct('user_id')->count('user_id');
            $criticalActions = AuditLog::whereIn('action', ['delete', 'update', 'approve'])->count();
            
            // Get action breakdown
            $actionStats = AuditLog::select('action', \DB::raw('count(*) as count'))
                ->groupBy('action')
                ->orderByDesc('count')
                ->limit(5)
                ->get();
            
            // Recent critical activities
            $criticalLogs = AuditLog::whereIn('action', ['delete', 'approve', 'reject'])
                ->latest()
                ->limit(5)
                ->get();
            
        } catch (\Exception $e) {
            $logs = new LengthAwarePaginator([], 0, 20);
            $totalLogs = 0;
            $todayLogs = 0;
            $uniqueUsers = 0;
            $criticalActions = 0;
            $actionStats = collect();
            $criticalLogs = collect();
        }
        
        return view('admin.system.audit-logs', compact(
            'logs', 'totalLogs', 'todayLogs', 'uniqueUsers', 
            'criticalActions', 'actionStats', 'criticalLogs'
        ));
    }

    /**
     * Generate a new API key
     */
    public function generateApiKey(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'environment' => 'required|in:production,sandbox',
                'rate_limit' => 'nullable|integer|min:1',
            ]);

            // Generate secure random API key
            $apiKey = 'sk_' . bin2hex(random_bytes(32));
            $apiSecret = bin2hex(random_bytes(32));

            $key = DeveloperApiKey::create([
                'key_name' => $validated['name'],
                'api_key' => $apiKey,
                'api_secret_hash' => bcrypt($apiSecret),
                'permissions' => ['read', 'write'],
                'rate_limit_per_minute' => $validated['rate_limit'] ?? 100,
                'is_active' => true,
            ]);

            // Log the action
            if (class_exists(AuditLog::class)) {
                AuditLog::create([
                    'user_id' => auth()->id(),
                    'action' => 'create',
                    'description' => 'Generated API key: ' . $validated['name'],
                    'model_type' => 'DeveloperApiKey',
                    'model_id' => $key->id,
                    'ip_address' => request()->ip(),
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'API key generated successfully',
                'key' => [
                    'id' => $key->id,
                    'name' => $key->key_name,
                    'api_key' => $apiKey,
                    'api_secret' => $apiSecret,
                    'created_at' => $key->created_at->format('Y-m-d H:i:s'),
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to generate API key: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Revoke an API key
     */
    public function revokeApiKey($keyId)
    {
        try {
            $key = DeveloperApiKey::findOrFail($keyId);
            
            $key->update(['is_active' => false]);

            // Log the action
            if (class_exists(AuditLog::class)) {
                AuditLog::create([
                    'user_id' => auth()->id(),
                    'action' => 'delete',
                    'description' => 'Revoked API key: ' . $key->key_name,
                    'model_type' => 'DeveloperApiKey',
                    'model_id' => $key->id,
                    'ip_address' => request()->ip(),
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'API key revoked successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to revoke API key: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Export system data/report
     */
    public function exportSystemReport(Request $request)
    {
        try {
            $type = $request->get('type', 'summary'); // summary, detailed, audit
            
            $data = [
                'export_date' => now()->format('Y-m-d H:i:s'),
                'exported_by' => auth()->user()->name ?? 'System',
            ];

            if ($type === 'summary' || $type === 'detailed') {
                $data['system_stats'] = [
                    'total_users' => \App\Models\User::count(),
                    'active_users' => \App\Models\User::where('status', 'active')->count(),
                    'total_policies' => \App\Models\CustomerPolicy::count() ?? 0,
                    'total_revenue' => \App\Models\PaymentTransaction::where('status', 'completed')->sum('amount') ?? 0,
                    'total_claims' => \App\Models\Claim::count() ?? 0,
                    'pending_claims' => \App\Models\Claim::where('status', 'pending')->count() ?? 0,
                ];
            }

            if ($type === 'detailed') {
                $data['user_breakdown'] = \App\Models\User::select('roles.name', \DB::raw('count(*) as count'))
                    ->join('role_user', 'users.id', '=', 'role_user.user_id')
                    ->join('roles', 'role_user.role_id', '=', 'roles.id')
                    ->groupBy('roles.name')
                    ->get()
                    ->toArray();
            }

            if ($type === 'audit') {
                $data['recent_audits'] = AuditLog::latest()->limit(100)->get()->toArray();
            }

            // Create JSON export
            $filename = 'system-report-' . strtolower($type) . '-' . now()->format('Y-m-d-His') . '.json';
            
            return response()->json($data, 200, [
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to export report: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Upload system document/file
     */
    public function uploadDocument(Request $request)
    {
        try {
            $validated = $request->validate([
                'document' => 'required|file|mimes:pdf,docx,xlsx,doc,xls|max:10240',
                'document_type' => 'required|string|in:policy,agreement,report,compliance,other',
                'description' => 'nullable|string|max:500',
            ]);

            if (!$request->hasFile('document') || !$request->file('document')->isValid()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid file upload',
                ], 400);
            }

            $file = $request->file('document');
            $filename = 'doc_' . time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
            $filepath = $file->storeAs('documents', $filename, 'public');

            // Create system document record if model exists
            if (class_exists(\App\Models\SystemDocument::class)) {
                \App\Models\SystemDocument::create([
                    'uploaded_by' => auth()->id(),
                    'document_type' => $validated['document_type'],
                    'file_path' => $filepath,
                    'original_filename' => $file->getClientOriginalName(),
                    'file_size' => $file->getSize(),
                    'mime_type' => $file->getMimeType(),
                    'description' => $validated['description'] ?? null,
                ]);
            }

            // Log the action
            if (class_exists(AuditLog::class)) {
                AuditLog::create([
                    'user_id' => auth()->id(),
                    'action' => 'upload',
                    'description' => 'Uploaded system document: ' . $validated['document_type'],
                    'model_type' => 'SystemDocument',
                    'ip_address' => request()->ip(),
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Document uploaded successfully',
                'file' => [
                    'path' => $filepath,
                    'name' => $filename,
                    'size' => $file->getSize(),
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to upload document: ' . $e->getMessage(),
            ], 500);
        }
    }
}
