<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    // Show cart page
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = $this->calculateTotal($cart);
        
        return view('cart.index', compact('cart', 'total'));
    }
    
    // Add product to cart
    public function add(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);
        
        // Get cart from session (or create empty array)
        $cart = session()->get('cart', []);
        
        // Check if product already exists in cart
        if (isset($cart[$productId])) {
            // Increase quantity (check stock limit)
            if ($cart[$productId]['quantity'] < $product->stock) {
                $cart[$productId]['quantity']++;
            } else {
                return back()->with('error', 'Cannot add more. Stock limit reached.');
            }
        } else {
            // Add new product to cart
            $cart[$productId] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'image' => $product->image,
                'stock' => $product->stock
            ];
        }
        
        // Save cart back to session
        session()->put('cart', $cart);
        
        return back()->with('success', 'Product added to cart!');
    }
    
    // Update cart item quantity
    public function update(Request $request, $productId)
    {
        $cart = session()->get('cart', []);
        
        if (isset($cart[$productId])) {
            $quantity = $request->input('quantity');
            
            // Validate quantity
            if ($quantity > 0 && $quantity <= $cart[$productId]['stock']) {
                $cart[$productId]['quantity'] = $quantity;
                session()->put('cart', $cart);
                
                return back()->with('success', 'Cart updated!');
            } else {
                return back()->with('error', 'Invalid quantity.');
            }
        }
        
        return back()->with('error', 'Product not found in cart.');
    }
    
    // Remove item from cart
    public function remove($productId)
    {
        $cart = session()->get('cart', []);
        
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
            
            return back()->with('success', 'Product removed from cart.');
        }
        
        return back()->with('error', 'Product not found in cart.');
    }
    
    // Clear entire cart
    public function clear()
    {
        session()->forget('cart');
        return back()->with('success', 'Cart cleared!');
    }
    
    // Helper function to calculate cart total
    private function calculateTotal($cart)
    {
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }
    
    // Get cart item count (for navbar badge)
    public function getCartCount()
    {
        $cart = session()->get('cart', []);
        $count = 0;
        
        foreach ($cart as $item) {
            $count += $item['quantity'];
        }
        
        return $count;
    }
}