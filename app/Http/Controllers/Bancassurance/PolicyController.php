<?php

namespace App\Http\Controllers\Bancassurance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PolicyController extends Controller
{
    public function index()
    {
        return view('bancassurance.policies.index');
    }
    
    public function sales()
    {
        return view('bancassurance.sales.index');
    }
    
    public function mySales()
    {
        return view('bancassurance.my-sales.index');
    }
}
