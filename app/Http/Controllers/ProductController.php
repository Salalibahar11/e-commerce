<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Product::distinct()->pluck('category');
        
        $query = Product::query();
        
        if ($request->has('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }
        
        $products = $query->get();
        $selectedCategory = $request->get('category', 'all');
        
        return view('products.index', compact('products', 'categories', 'selectedCategory'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }
}