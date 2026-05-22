<?php

namespace App\Http\Controllers\Bancassurance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
}
