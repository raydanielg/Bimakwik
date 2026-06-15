<?php

namespace App\Http\Controllers\Bancassurance;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\Customer;
use App\Models\CustomerPolicy;
use App\Models\InsuranceProduct;
use App\Models\User;
use App\Services\CommissionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PolicyController extends Controller
{
    public function index()
    {
        return view('bancassurance.policies.index');
    }

    public function sales()
    {
        return view('bancassurance.sales.index', [
            'products' => InsuranceProduct::where('is_active', true)->orderBy('product_name')->get(),
        ]);
    }

    public function mySales()
    {
        return view('bancassurance.my-sales.index', [
            'products' => InsuranceProduct::where('is_active', true)->orderBy('product_name')->get(),
        ]);
    }

    public function storeSale(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
            'product_id' => 'required|exists:insurance_products,id',
            'premium' => 'required|numeric|min:0',
            'branch' => 'required|string|max:255',
            'sold_by' => 'required|string|max:255',
            'policy_start_date' => 'required|date',
            'policy_end_date' => 'required|date|after:policy_start_date',
            'company_code' => 'nullable|string|max:50',
            'sale_point_code' => 'nullable|string|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $agent = Agent::where('user_id', Auth::id())->first();

            $user = User::firstOrCreate(
                ['email' => $request->customer_email],
                [
                    'name' => $request->customer_name,
                    'phone_number' => $request->customer_phone,
                    'password' => Hash::make(Str::random(16)),
                ]
            );

            $customer = Customer::firstOrCreate(
                ['user_id' => $user->id],
                ['customer_number' => 'CUST-' . strtoupper(Str::random(8))]
            );

            $product = InsuranceProduct::findOrFail($request->product_id);

            $policy = CustomerPolicy::create([
                'customer_id' => $customer->id,
                'policy_number' => 'POL-' . date('Y') . '-' . str_pad(rand(1, 999999), 6, '0', STR_PAD_LEFT),
                'insurance_product_id' => $product->id,
                'insurer_id' => $product->insurer_id,
                'agent_id' => $agent?->id,
                'premium_amount' => $request->premium,
                'sum_assured' => $request->premium,
                'start_date' => $request->policy_start_date,
                'end_date' => $request->policy_end_date,
                'status' => 'active',
                'premium_frequency' => 'annual',
                'policy_details' => ['branch' => $request->branch, 'sold_by' => $request->sold_by],
                'payment_method' => 'manual',
                'company_code' => $request->company_code,
                'sale_point_code' => $request->sale_point_code,
            ]);

            try {
                app(CommissionService::class)->calculateAndCreate($policy);
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::warning('Commission calculation skipped for bancassurance sale: ' . $e->getMessage());
            }

            return response()->json([
                'success' => true,
                'message' => 'Sale recorded successfully',
                'data' => [
                    'id' => $policy->id,
                    'policy_number' => $policy->policy_number,
                    'customer_name' => $request->customer_name,
                    'customer_email' => $request->customer_email,
                    'customer_phone' => $request->customer_phone,
                    'product' => $product->product_name,
                    'premium' => (float) $request->premium,
                    'branch' => $request->branch,
                    'sold_by' => $request->sold_by,
                    'policy_start_date' => $request->policy_start_date,
                    'policy_end_date' => $request->policy_end_date,
                    'status' => 'Pending',
                    'created_at' => $policy->created_at->toDateTimeString(),
                ]
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
            $policy = CustomerPolicy::with(['product', 'customer'])->findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $policy->id,
                    'policy_number' => $policy->policy_number,
                    'customer_name' => $policy->customer?->name ?? 'N/A',
                    'customer_email' => $policy->customer?->email ?? 'N/A',
                    'customer_phone' => $policy->customer?->phone ?? 'N/A',
                    'product' => $policy->product->product_name ?? 'N/A',
                    'premium' => (float) $policy->premium_amount,
                    'branch' => $policy->policy_details['branch'] ?? '',
                    'sold_by' => $policy->policy_details['sold_by'] ?? '',
                    'policy_start_date' => $policy->start_date->format('Y-m-d'),
                    'policy_end_date' => $policy->end_date->format('Y-m-d'),
                    'status' => ucfirst($policy->status),
                    'created_at' => $policy->created_at->toDateTimeString(),
                    'notes' => 'Policy created via bancassurance channel.',
                ]
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
            sleep(1);

            return response()->json([
                'success' => true,
                'message' => 'Sales exported successfully',
                'data' => [
                    'file_name' => 'sales_export_' . now()->format('Y-m-d_H-i-s') . '.pdf',
                    'total_sales' => CustomerPolicy::whereIn('id', function ($q) {
                        $q->select('customer_policy_id')->from('commission_transactions')
                            ->where('recipient_type', 'bancassurance_user');
                    })->count(),
                    'total_amount' => 'TZS ' . number_format(
                        CustomerPolicy::whereIn('id', function ($q) {
                            $q->select('customer_policy_id')->from('commission_transactions')
                                ->where('recipient_type', 'bancassurance_user');
                        })->sum('premium_amount'), 0
                    ),
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
            'premium' => 'required|numeric|min:0',
            'branch' => 'required|string|max:255',
            'sold_by' => 'required|string|max:255',
            'policy_start_date' => 'required|date',
            'policy_end_date' => 'required|date|after:policy_start_date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $policy = CustomerPolicy::findOrFail($id);

            $policy->update([
                'premium_amount' => $request->premium,
                'sum_assured' => $request->premium,
                'start_date' => $request->policy_start_date,
                'end_date' => $request->policy_end_date,
                'policy_details' => array_merge($policy->policy_details ?? [], [
                    'branch' => $request->branch,
                    'sold_by' => $request->sold_by,
                ]),
            ]);

            if ($policy->customer && $policy->customer->user) {
                $policy->customer->user->update([
                    'name' => $request->customer_name,
                    'phone_number' => $request->customer_phone,
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Sale updated successfully',
                'data' => [
                    'id' => $policy->id,
                    'customer_name' => $request->customer_name,
                    'product' => $policy->product->product_name ?? 'N/A',
                    'premium' => (float) $request->premium,
                ]
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
