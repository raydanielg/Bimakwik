<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerPolicy;
use App\Models\PolicyDocument;
use Illuminate\Support\Facades\DB;

class CustomerDocumentController extends Controller
{
    public function index()
    {
        $documents = collect();
        try {
            $customerId = DB::table('customers')->where('user_id', auth()->id())->value('id');
            if ($customerId) {
                $documents = PolicyDocument::whereHas('policy', function($q) use ($customerId) {
                    $q->where('customer_id', $customerId);
                })->with('policy')->latest()->paginate(15);
            }
        } catch (\Exception $e) {}
        return view('customer.policies.documents', compact('documents'));
    }
}
