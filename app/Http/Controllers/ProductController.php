<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // Display all products
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    // Show the form for creating a new product
    public function create()
    {
        return view('products.create');
    }

    // Store a new product in the database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // Create a new product with the default 'active' status
        Product::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'status' => 'active', // default status is 'active'
        ]);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }
}
