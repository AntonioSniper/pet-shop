<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::withCount([
            'products' => fn ($query) => $query->where('is_active', true),
        ])->orderBy('name')->get();

        $activeCategory = $categories->firstWhere('slug', $request->query('category'));

        $products = Product::with('category')
            ->when($activeCategory, fn ($query) => $query->where('category_id', $activeCategory->id))
            ->where('is_active', true)
            ->latest()
            ->get();

        return view('home', compact('products', 'categories', 'activeCategory'));
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }
}
