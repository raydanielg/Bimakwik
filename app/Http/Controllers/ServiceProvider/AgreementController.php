<?php

namespace App\Http\Controllers\ServiceProvider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AgreementController extends Controller
{
    public function index()
    {
        return view('service_provider.agreements.index');
    }
}
