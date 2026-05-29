<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $categoryId = $request->query('category');
        $search = $request->query('search');

        $query = Product::with('category');

        if ($categoryId) {
            $category = Category::with('children')->find($categoryId);
            if ($category) {
                $categoryIds = $category->children()->pluck('id')->push($categoryId);
                $query->whereIn('category_id', $categoryIds);
            }
        }

        if ($search) {
            $query->whereRaw('MATCH(name, description) AGAINST(? IN BOOLEAN MODE)', [$search]);
        }

        $products = $query->orderBy('created_at', 'desc')->paginate(12);

        return view('products.index', compact('products', 'categories', 'categoryId', 'search'));
    }

    public function show($id)
    {
        $product = Product::with('category', 'images')->findOrFail($id);

        $relatedProducts = Product::where('category_id', $product->category_id)
                                  ->where('id', '!=', $product->id)
                                  ->limit(4)
                                  ->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }
}
