<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerPolicy;
use App\Models\PolicyDocument;

class CustomerDocumentController extends Controller
{
    public function index()
    {
        $documents = collect();
        try {
            $documents = PolicyDocument::whereHas('policy', function($q) {
                $q->where('customer_id', auth()->id());
            })->with('policy')->latest()->paginate(15);
        } catch (\Exception $e) {}
        return view('customer.policies.documents', compact('documents'));
    }
}
