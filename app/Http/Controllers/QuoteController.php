<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuoteController extends Controller
{
    //
    public function show()
    {
        return view('quote');
    }

    public function store(Request $request)
    {
        // Simple validation
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'insurance_type' => 'required',
        ]);

        // Logic for handling the quote (e.g., email or save to DB) can go here
        
        return back()->with('success', 'Your quote request has been submitted successfully! We will contact you shortly.');
    }
}
