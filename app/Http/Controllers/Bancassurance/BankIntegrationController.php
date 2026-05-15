<?php

namespace App\Http\Controllers\Bancassurance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BankIntegrationController extends Controller
{
    public function index()
    {
        return view('bancassurance.integration.index');
    }
}
