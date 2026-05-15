<?php

namespace App\Http\Controllers\FinancingPartner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RepaymentController extends Controller
{
    public function index()
    {
        return view('financing_partner.repayments.index');
    }
}
