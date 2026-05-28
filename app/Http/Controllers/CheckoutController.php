<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }
        $total = $this->calculateTotal($cart);
        return view('checkout.index', compact('cart', 'total'));
    }

    public function placeOrder(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
            'country' => 'required|string|max:2',
            'payment_method' => 'required|in:cod',
        ]);

        DB::beginTransaction();
        try {
            foreach ($cart as $productId => $item) {
                $product = Product::lockForUpdate()->find($productId);
                if (!$product) {
                    DB::rollBack();
                    return back()->with('error', "Product '{$item['name']}' is no longer available.");
                }
                if ($product->stock < $item['quantity']) {
                    DB::rollBack();
                    return back()->with('error', "Insufficient stock for '{$product->name}'. Only {$product->stock} left.");
                }
            }

            $total = $this->calculateTotal($cart);
            $orderNumber = 'ORD-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -6));

            $order = Order::create(array_merge($data, [
                'user_id' => auth()->id(),
                'order_number' => $orderNumber,
                'total_price' => $total,
                'status' => 'pending',
                'payment_status' => 'pending',
            ]));

            foreach ($cart as $productId => $item) {
                $product = Product::find($productId);
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'product_name' => $item['name'],
                    'product_price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'subtotal' => $item['price'] * $item['quantity'],
                ]);
                $product->decrement('stock', $item['quantity']);
            }

            session()->forget('cart');
            DB::commit();

            return redirect()->route('checkout.confirmation', $order->id);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function confirmation($id)
    {
        $order = Order::with('items')->findOrFail($id);
        return view('checkout.confirmation', compact('order'));
    }

    private function calculateTotal($cart)
    {
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }
}
