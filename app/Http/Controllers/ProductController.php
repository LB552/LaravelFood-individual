<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::with('category');

        // Handle category filter
        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }

        // Handle price range filter
        $minPrice = $request->get('min_price');
        $maxPrice = $request->get('max_price');

        if ($minPrice !== null && $minPrice !== '') {
            $query->where('price', '>=', $minPrice);
        }

        if ($maxPrice !== null && $maxPrice !== '') {
            $query->where('price', '<=', $maxPrice);
        }

        // Handle sorting
        $sortBy = $request->get('sort_by', 'name');
        $sortOrder = $request->get('sort_order', 'asc');

        // Validate sort parameters to prevent injection
        if (!in_array($sortBy, ['name', 'category_id', 'price'])) {
            $sortBy = 'name';
        }
        if (!in_array($sortOrder, ['asc', 'desc'])) {
            $sortOrder = 'asc';
        }

        if ($sortBy === 'category_id') {
            $query->join('categories', 'products.category_id', '=', 'categories.id')
                ->select('products.*')
                ->orderByRaw("LOWER(categories.name) {$sortOrder}");
        } else if ($sortBy === 'name') {
            $query->orderByRaw("LOWER(name) {$sortOrder}");
        } else {
            $query->orderBy($sortBy, $sortOrder);
        }

        $products = $query->paginate(10)->withQueryString();

        // Make sure to get categories
        $categories = Category::orderBy('name')->get();

        return view('index', compact('products', 'categories', 'sortBy', 'sortOrder', 'minPrice', 'maxPrice'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|string|max:500',
        ]);

        Product::create($validated);

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Product created successfully'], 201);
        }

        return redirect()->back()->with('success', 'Product created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product->load('category');

        return view('product', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|string|max:500',
        ]);

        $product->update($validated);

        return redirect()->back()->with('success', 'Product updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(['message' => 'Product deleted successfully'], 200);
    }
}
