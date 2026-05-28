<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart - Elo</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Arial', sans-serif;
            background: #f5f5f5;
        }
        .navbar {
            background: #000;
            color: #fff;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .navbar h1 {
            font-size: 24px;
            font-weight: bold;
        }
        .navbar-links {
            display: flex;
            gap: 20px;
            align-items: center;
        }
        .navbar-links a {
            color: #fff;
            text-decoration: none;
            padding: 8px 15px;
            border-radius: 4px;
            transition: background 0.3s;
            position: relative;
        }
        .navbar-links a:hover {
            background: #333;
        }
        .cart-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #dc3545;
            color: #fff;
            border-radius: 50%;
            padding: 2px 6px;
            font-size: 11px;
            font-weight: bold;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 30px 20px;
        }
        .page-title {
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 30px;
            color: #333;
        }
        .alert {
            padding: 15px 20px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 14px;
        }
        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .cart-container {
            display: grid;
            grid-template-columns: 1fr 400px;
            gap: 30px;
        }
        .cart-items {
            background: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        .cart-item {
            display: grid;
            grid-template-columns: 100px 1fr auto;
            gap: 20px;
            padding: 20px 0;
            border-bottom: 1px solid #eee;
        }
        .cart-item:last-child {
            border-bottom: none;
        }
        .item-image {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 32px;
            font-weight: bold;
        }
        .item-details {
            display: flex;
            flex-direction: column;
            gap: 8px;
            justify-content: center;
        }
        .item-name {
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }
        .item-price {
            font-size: 16px;
            color: #666;
        }
        .item-actions {
            display: flex;
            flex-direction: column;
            gap: 10px;
            align-items: flex-end;
            justify-content: center;
        }
        .quantity-control {
            display: flex;
            gap: 10px;
            align-items: center;
        }
        .quantity-input {
            width: 60px;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            text-align: center;
            font-size: 14px;
        }
        .update-btn {
            background: #28a745;
            color: #fff;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 13px;
        }
        .update-btn:hover {
            background: #218838;
        }
        .remove-btn {
            background: #dc3545;
            color: #fff;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 13px;
        }
        .remove-btn:hover {
            background: #c82333;
        }
        .item-subtotal {
            font-size: 20px;
            font-weight: bold;
            color: #000;
        }
        .cart-summary {
            background: #fff;
            border-radius: 8px;
            padding: 25px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            height: fit-content;
            position: sticky;
            top: 20px;
        }
        .summary-title {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #333;
        }
        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #eee;
        }
        .summary-row:last-child {
            border-bottom: none;
            font-size: 20px;
            font-weight: bold;
            padding-top: 20px;
            border-top: 2px solid #000;
        }
        .checkout-btn {
            width: 100%;
            background: #000;
            color: #fff;
            border: none;
            padding: 16px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 6px;
            cursor: pointer;
            margin-top: 20px;
        }
        .checkout-btn:hover {
            background: #333;
        }
        .continue-shopping {
            width: 100%;
            background: #fff;
            color: #000;
            border: 2px solid #000;
            padding: 14px;
            font-size: 14px;
            font-weight: bold;
            border-radius: 6px;
            cursor: pointer;
            margin-top: 10px;
            text-align: center;
            text-decoration: none;
            display: block;
        }
        .continue-shopping:hover {
            background: #f5f5f5;
        }
        .empty-cart {
            text-align: center;
            padding: 60px 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        .empty-cart h2 {
            font-size: 28px;
            color: #666;
            margin-bottom: 15px;
        }
        .empty-cart p {
            font-size: 16px;
            color: #999;
            margin-bottom: 25px;
        }
        .shop-now-btn {
            background: #000;
            color: #fff;
            padding: 14px 30px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
            display: inline-block;
        }
        .shop-now-btn:hover {
            background: #333;
        }
        .clear-cart-btn {
            background: #6c757d;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            margin-bottom: 20px;
        }
        .clear-cart-btn:hover {
            background: #5a6268;
        }
        @media (max-width: 968px) {
            .cart-container {
                grid-template-columns: 1fr;
            }
            .cart-summary {
                position: static;
            }
            .cart-item {
                grid-template-columns: 80px 1fr;
                gap: 15px;
            }
            .item-actions {
                grid-column: 1 / -1;
                flex-direction: row;
                justify-content: space-between;
                align-items: center;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar">
        <h1>elo</h1>
        <div class="navbar-links">
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('products.index') }}">Shop</a>
            <a href="{{ route('cart.index') }}">
                Cart
                @if(count(session()->get('cart', [])) > 0)
                    <span class="cart-badge">{{ array_sum(array_column(session()->get('cart', []), 'quantity')) }}</span>
                @endif
            </a>
            @auth
                <a href="{{ route('dashboard') }}">Dashboard</a>
            @else
                <a href="{{ route('login') }}">Login</a>
            @endauth
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container">
        <h1 class="page-title">Shopping Cart</h1>

        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        @if(count($cart) > 0)
            <div class="cart-container">
                <!-- Cart Items -->
                <div class="cart-items">
                    <form method="POST" action="{{ route('cart.clear') }}" style="margin-bottom: 15px;">
                        @csrf
                        <button type="submit" class="clear-cart-btn" onclick="return confirm('Are you sure you want to clear the cart?')">
                            Clear Cart
                        </button>
                    </form>

                    @foreach($cart as $id => $item)
                        <div class="cart-item">
                            <div class="item-image">
                                {{ strtoupper(substr($item['name'], 0, 1)) }}
                            </div>
                            
                            <div class="item-details">
                                <div class="item-name">{{ $item['name'] }}</div>
                                <div class="item-price">Rs {{ number_format($item['price'], 2) }} each</div>
                                <div style="font-size: 12px; color: #999;">{{ $item['stock'] }} available</div>
                            </div>
                            
                            <div class="item-actions">
                                <div class="item-subtotal">Rs {{ number_format($item['price'] * $item['quantity'], 2) }}</div>
                                
                                <form method="POST" action="{{ route('cart.update', $id) }}" class="quantity-control">
                                    @csrf
                                    <input 
                                        type="number" 
                                        name="quantity" 
                                        value="{{ $item['quantity'] }}" 
                                        min="1" 
                                        max="{{ $item['stock'] }}" 
                                        class="quantity-input"
                                    >
                                    <button type="submit" class="update-btn">Update</button>
                                </form>
                                
                                <form method="POST" action="{{ route('cart.remove', $id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="remove-btn">Remove</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Cart Summary -->
                <div class="cart-summary">
                    <h2 class="summary-title">Order Summary</h2>
                    
                    <div class="summary-row">
                        <span>Subtotal</span>
                        <span>Rs {{ number_format($total, 2) }}</span>
                    </div>
                    
                    <div class="summary-row">
                        <span>Shipping</span>
                        <span>Free</span>
                    </div>
                    
                    <div class="summary-row">
                        <span>Total</span>
                        <span>Rs {{ number_format($total, 2) }}</span>
                    </div>
                    
                    <a href="{{ route('checkout.index') }}" class="checkout-btn" style="display:block;text-align:center;text-decoration:none;">Proceed to Checkout</a>
                    <a href="{{ route('products.index') }}" class="continue-shopping">Continue Shopping</a>
                </div>
            </div>
        @else
            <!-- Empty Cart -->
            <div class="empty-cart">
                <h2>Your cart is empty</h2>
                <p>Looks like you haven't added anything to your cart yet</p>
                <a href="{{ route('products.index') }}" class="shop-now-btn">Start Shopping</a>
            </div>
        @endif
    </div>
</body>
</html>