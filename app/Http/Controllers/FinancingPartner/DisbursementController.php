<?php

namespace App\Http\Controllers\FinancingPartner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DisbursementController extends Controller
{
    public function index()
    {
        return view('financing_partner.disbursements.index');
    }
}
