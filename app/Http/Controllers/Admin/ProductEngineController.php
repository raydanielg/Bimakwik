<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\ComparisonMatrix;

class ProductEngineController extends Controller
{
    public function productList()
    {
        $products = Product::with('category', 'insurer')->paginate(20);
        $categories = Category::all();
        return view('admin.products.index', compact('products', 'categories'));
    }

    public function lowCodeBuilder()
    {
        $categories = Category::all();
        return view('admin.products.builder', compact('categories'));
    }

    public function comparisonMatrix()
    {
        $products = Product::with('category')->active()->get();
        $matrices = ComparisonMatrix::with('products')->paginate(20);
        return view('admin.products.comparison', compact('products', 'matrices'));
    }
}
