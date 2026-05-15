<?php

namespace App\Http\Controllers\Bancassurance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        return view('bancassurance.customers.index');
    }
}
