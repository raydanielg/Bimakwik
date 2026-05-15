<?php

namespace App\Http\Controllers\Developer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UsageController extends Controller
{
    public function index()
    {
        return view('developer.usage.index');
    }
}
