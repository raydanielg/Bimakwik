<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class BancassuranceController extends Controller
{
    public function bankIntegration()
    {
        try {
            // Mock bank integration data
            $banks = collect([
                ['id' => 1, 'name' => 'CRDB Bank', 'status' => 'active', 'customers' => 1250, 'transactions' => 4500, 'last_sync' => '5 mins ago'],
                ['id' => 2, 'name' => 'NMB Bank', 'status' => 'active', 'customers' => 980, 'transactions' => 3200, 'last_sync' => '10 mins ago'],
                ['id' => 3, 'name' => 'Tanzania Commercial Bank', 'status' => 'active', 'customers' => 750, 'transactions' => 2100, 'last_sync' => '15 mins ago'],
                ['id' => 4, 'name' => 'Equity Bank', 'status' => 'pending', 'customers' => 0, 'transactions' => 0, 'last_sync' => 'Not synced'],
                ['id' => 5, 'name' => 'KCB Bank', 'status' => 'inactive', 'customers' => 450, 'transactions' => 1200, 'last_sync' => '2 days ago'],
            ]);
            
            $page = request()->get('page', 1);
            $perPage = 10;
            $offset = ($page - 1) * $perPage;
            $paginatedBanks = $banks->slice($offset, $perPage)->values();
            
            $banks = new LengthAwarePaginator(
                $paginatedBanks,
                $banks->count(),
                $perPage,
                $page,
                ['path' => request()->url(), 'query' => request()->query()]
            );
            
        } catch (\Exception $e) {
            $banks = new LengthAwarePaginator([], 0, 10);
        }
        
        return view('admin.bancassurance.bank-integration', compact('banks'));
    }
    
    public function bankCustomers()
    {
        try {
            // Mock bank customers data
            $customers = collect([
                ['id' => 1, 'name' => 'John Mwangi', 'account_number' => 'CRDB-001234', 'bank' => 'CRDB Bank', 'products' => 3, 'total_premium' => 1250000, 'status' => 'active', 'joined' => '2024-01-15'],
                ['id' => 2, 'name' => 'Sarah Kimani', 'account_number' => 'NMB-005678', 'bank' => 'NMB Bank', 'products' => 2, 'total_premium' => 850000, 'status' => 'active', 'joined' => '2024-02-20'],
                ['id' => 3, 'name' => 'David Omondi', 'account_number' => 'TCB-009012', 'bank' => 'TCB', 'products' => 1, 'total_premium' => 450000, 'status' => 'pending', 'joined' => '2024-03-10'],
                ['id' => 4, 'name' => 'Grace Muthoni', 'account_number' => 'CRDB-003456', 'bank' => 'CRDB Bank', 'products' => 4, 'total_premium' => 2100000, 'status' => 'active', 'joined' => '2024-01-25'],
                ['id' => 5, 'name' => 'Peter Kamau', 'account_number' => 'NMB-007890', 'bank' => 'NMB Bank', 'products' => 2, 'total_premium' => 980000, 'status' => 'inactive', 'joined' => '2023-12-05'],
            ]);
            
            $page = request()->get('page', 1);
            $perPage = 20;
            $offset = ($page - 1) * $perPage;
            $paginatedCustomers = $customers->slice($offset, $perPage)->values();
            
            $customers = new LengthAwarePaginator(
                $paginatedCustomers,
                $customers->count(),
                $perPage,
                $page,
                ['path' => request()->url(), 'query' => request()->query()]
            );
            
        } catch (\Exception $e) {
            $customers = new LengthAwarePaginator([], 0, 20);
        }
        
        return view('admin.bancassurance.bank-customers', compact('customers'));
    }
    
    public function insuranceSales()
    {
        try {
            // Mock insurance sales data
            $sales = collect([
                ['id' => 1, 'policy_number' => 'POL-2024-001', 'customer' => 'John Mwangi', 'product' => 'Motor Insurance', 'premium' => 450000, 'bank' => 'CRDB Bank', 'agent' => 'Agent A', 'status' => 'active', 'date' => '2024-05-15'],
                ['id' => 2, 'policy_number' => 'POL-2024-002', 'customer' => 'Sarah Kimani', 'product' => 'Health Insurance', 'premium' => 280000, 'bank' => 'NMB Bank', 'agent' => 'Agent B', 'status' => 'active', 'date' => '2024-05-14'],
                ['id' => 3, 'policy_number' => 'POL-2024-003', 'customer' => 'David Omondi', 'product' => 'Life Insurance', 'premium' => 120000, 'bank' => 'TCB', 'agent' => 'Agent C', 'status' => 'pending', 'date' => '2024-05-13'],
                ['id' => 4, 'policy_number' => 'POL-2024-004', 'customer' => 'Grace Muthoni', 'product' => 'Motor Insurance', 'premium' => 380000, 'bank' => 'CRDB Bank', 'agent' => 'Agent A', 'status' => 'active', 'date' => '2024-05-12'],
                ['id' => 5, 'policy_number' => 'POL-2024-005', 'customer' => 'Peter Kamau', 'product' => 'General Insurance', 'premium' => 650000, 'bank' => 'NMB Bank', 'agent' => 'Agent B', 'status' => 'expired', 'date' => '2024-05-10'],
            ]);
            
            $page = request()->get('page', 1);
            $perPage = 20;
            $offset = ($page - 1) * $perPage;
            $paginatedSales = $sales->slice($offset, $perPage)->values();
            
            $sales = new LengthAwarePaginator(
                $paginatedSales,
                $sales->count(),
                $perPage,
                $page,
                ['path' => request()->url(), 'query' => request()->query()]
            );
            
        } catch (\Exception $e) {
            $sales = new LengthAwarePaginator([], 0, 20);
        }
        
        return view('admin.bancassurance.insurance-sales', compact('sales'));
    }
    
    public function mySales()
    {
        try {
            // Mock my sales data
            $mySales = collect([
                ['id' => 1, 'policy_number' => 'POL-2024-001', 'customer' => 'John Mwangi', 'product' => 'Motor Insurance', 'premium' => 450000, 'commission' => 22500, 'status' => 'paid', 'date' => '2024-05-15'],
                ['id' => 2, 'policy_number' => 'POL-2024-004', 'customer' => 'Grace Muthoni', 'product' => 'Motor Insurance', 'premium' => 380000, 'commission' => 19000, 'status' => 'paid', 'date' => '2024-05-12'],
                ['id' => 3, 'policy_number' => 'POL-2024-006', 'customer' => 'Alice Njoroge', 'product' => 'Health Insurance', 'premium' => 320000, 'commission' => 16000, 'status' => 'pending', 'date' => '2024-05-10'],
                ['id' => 4, 'policy_number' => 'POL-2024-007', 'customer' => 'James Kipkorir', 'product' => 'Life Insurance', 'premium' => 150000, 'commission' => 7500, 'status' => 'paid', 'date' => '2024-05-08'],
                ['id' => 5, 'policy_number' => 'POL-2024-008', 'customer' => 'Mary Wanjiku', 'product' => 'General Insurance', 'premium' => 550000, 'commission' => 27500, 'status' => 'pending', 'date' => '2024-05-05'],
            ]);
            
            $totalSales = $mySales->sum('premium');
            $totalCommission = $mySales->where('status', 'paid')->sum('commission');
            $pendingCommission = $mySales->where('status', 'pending')->sum('commission');
            
            $page = request()->get('page', 1);
            $perPage = 20;
            $offset = ($page - 1) * $perPage;
            $paginatedSales = $mySales->slice($offset, $perPage)->values();
            
            $mySales = new LengthAwarePaginator(
                $paginatedSales,
                $mySales->count(),
                $perPage,
                $page,
                ['path' => request()->url(), 'query' => request()->query()]
            );
            
        } catch (\Exception $e) {
            $mySales = new LengthAwarePaginator([], 0, 20);
            $totalSales = 0;
            $totalCommission = 0;
            $pendingCommission = 0;
        }
        
        return view('admin.bancassurance.my-sales', compact('mySales', 'totalSales', 'totalCommission', 'pendingCommission'));
    }
    
    public function bancassuranceProducts()
    {
        try {
            // Mock bancassurance products data
            $products = collect([
                ['id' => 1, 'name' => 'Motor Insurance', 'category' => 'General', 'premium_range' => '50,000 - 2,000,000', 'commission_rate' => '5%', 'banks' => 5, 'status' => 'active'],
                ['id' => 2, 'name' => 'Health Insurance', 'category' => 'Health', 'premium_range' => '100,000 - 5,000,000', 'commission_rate' => '7%', 'banks' => 4, 'status' => 'active'],
                ['id' => 3, 'name' => 'Life Insurance', 'category' => 'Life', 'premium_range' => '20,000 - 10,000,000', 'commission_rate' => '10%', 'banks' => 3, 'status' => 'active'],
                ['id' => 4, 'name' => 'Travel Insurance', 'category' => 'General', 'premium_range' => '10,000 - 500,000', 'commission_rate' => '4%', 'banks' => 2, 'status' => 'pending'],
                ['id' => 5, 'name' => 'Property Insurance', 'category' => 'General', 'premium_range' => '100,000 - 15,000,000', 'commission_rate' => '6%', 'banks' => 3, 'status' => 'active'],
            ]);
            
            $page = request()->get('page', 1);
            $perPage = 20;
            $offset = ($page - 1) * $perPage;
            $paginatedProducts = $products->slice($offset, $perPage)->values();
            
            $products = new LengthAwarePaginator(
                $paginatedProducts,
                $products->count(),
                $perPage,
                $page,
                ['path' => request()->url(), 'query' => request()->query()]
            );
            
        } catch (\Exception $e) {
            $products = new LengthAwarePaginator([], 0, 20);
        }
        
        return view('admin.bancassurance.products', compact('products'));
    }
    
    public function complianceReports()
    {
        try {
            // Mock compliance reports data
            $reports = collect([
                ['id' => 1, 'report_type' => 'Monthly Sales Report', 'period' => 'May 2024', 'status' => 'completed', 'generated_by' => 'Admin', 'date' => '2024-05-01'],
                ['id' => 2, 'report_type' => 'Bank Performance Report', 'period' => 'Q1 2024', 'status' => 'completed', 'generated_by' => 'Admin', 'date' => '2024-04-15'],
                ['id' => 3, 'report_type' => 'Commission Report', 'period' => 'April 2024', 'status' => 'completed', 'generated_by' => 'Admin', 'date' => '2024-04-30'],
                ['id' => 4, 'report_type' => 'Compliance Audit', 'period' => 'Q2 2024', 'status' => 'pending', 'generated_by' => 'System', 'date' => '2024-06-01'],
                ['id' => 5, 'report_type' => 'Customer Analysis', 'period' => 'May 2024', 'status' => 'pending', 'generated_by' => 'System', 'date' => '2024-06-01'],
            ]);
            
            $page = request()->get('page', 1);
            $perPage = 20;
            $offset = ($page - 1) * $perPage;
            $paginatedReports = $reports->slice($offset, $perPage)->values();
            
            $reports = new LengthAwarePaginator(
                $paginatedReports,
                $reports->count(),
                $perPage,
                $page,
                ['path' => request()->url(), 'query' => request()->query()]
            );
            
        } catch (\Exception $e) {
            $reports = new LengthAwarePaginator([], 0, 20);
        }
        
        return view('admin.bancassurance.compliance-reports', compact('reports'));
    }
    
    public function performance()
    {
        try {
            // Mock performance data
            $performance = collect([
                ['id' => 1, 'bank' => 'CRDB Bank', 'sales' => 125, 'revenue' => 45000000, 'commission' => 2250000, 'growth' => '+18%', 'rank' => 1],
                ['id' => 2, 'bank' => 'NMB Bank', 'sales' => 98, 'revenue' => 32000000, 'commission' => 1600000, 'growth' => '+12%', 'rank' => 2],
                ['id' => 3, 'bank' => 'TCB', 'sales' => 75, 'revenue' => 21000000, 'commission' => 1050000, 'growth' => '+8%', 'rank' => 3],
                ['id' => 4, 'bank' => 'Equity Bank', 'sales' => 45, 'revenue' => 15000000, 'commission' => 750000, 'growth' => '+5%', 'rank' => 4],
                ['id' => 5, 'bank' => 'KCB Bank', 'sales' => 32, 'revenue' => 12000000, 'commission' => 600000, 'growth' => '+3%', 'rank' => 5],
            ]);
            
            $totalSales = $performance->sum('sales');
            $totalRevenue = $performance->sum('revenue');
            $totalCommission = $performance->sum('commission');
            
            $page = request()->get('page', 1);
            $perPage = 20;
            $offset = ($page - 1) * $perPage;
            $paginatedPerformance = $performance->slice($offset, $perPage)->values();
            
            $performance = new LengthAwarePaginator(
                $paginatedPerformance,
                $performance->count(),
                $perPage,
                $page,
                ['path' => request()->url(), 'query' => request()->query()]
            );
            
        } catch (\Exception $e) {
            $performance = new LengthAwarePaginator([], 0, 20);
            $totalSales = 0;
            $totalRevenue = 0;
            $totalCommission = 0;
        }
        
        return view('admin.bancassurance.performance', compact('performance', 'totalSales', 'totalRevenue', 'totalCommission'));
    }
}
