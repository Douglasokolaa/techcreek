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
        return view('backend.products', compact('products'));
    }

    public function update(Request $request, Product $product)
    {
        dd($product, $request->all());
    }
}
