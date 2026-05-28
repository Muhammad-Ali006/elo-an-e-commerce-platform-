<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::with('category')->where('stock', '>', 0)->latest()->take(8)->get();
        $categories = Category::whereNull('parent_id')->withCount('products')->get();
        $saleProducts = Product::with('category')->whereNotNull('sale_price')->where('sale_price', '<', 'price')->latest()->take(4)->get();

        return view('home', compact('featuredProducts', 'categories', 'saleProducts'));
    }
}
