<?php

namespace App\Http\Controllers\Developer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SandboxController extends Controller
{
    public function index()
    {
        return view('developer.sandbox.index');
    }
}
