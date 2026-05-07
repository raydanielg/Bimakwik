<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:newsletters,email',
        ], [
            'email.unique' => 'This email is already subscribed!',
        ]);

        Newsletter::create([
            'email' => $request->email,
        ]);

        return back()->with('success', 'Thank you for subscribing to our newsletter!');
    }
}
