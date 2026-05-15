<?php

namespace App\Http\Controllers\FinancingPartner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        return view('financing_partner.reports.index');
    }
}
