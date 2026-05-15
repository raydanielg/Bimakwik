<?php

namespace App\Http\Controllers\Sfe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        return view('sfe.products.index', [
            'products' => Product::where('is_active', true)->orderBy('name')->get(),
        ]);
    }
}
