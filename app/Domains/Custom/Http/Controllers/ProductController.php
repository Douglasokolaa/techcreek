<?php

namespace App\Domains\Custom\Http\Controllers;

use App\Domains\Custom\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('is_active', true)->get();
        return view('frontend.products', compact('products'));
    }

    public function update(Request $request, Product $product)
    {
        return view('backend.products-edit', compact('product'));
    }
}
