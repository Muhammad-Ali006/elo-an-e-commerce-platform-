<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmed - Elo</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Arial', sans-serif; background: #f5f5f5; display: flex; align-items: center; justify-content: center; min-height: 100vh; }
        .confirmation-card { background: #fff; border-radius: 12px; padding: 50px; text-align: center; box-shadow: 0 4px 20px rgba(0,0,0,0.1); max-width: 500px; width: 90%; }
        .check-icon { width: 80px; height: 80px; background: #28a745; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; color: #fff; font-size: 40px; }
        h1 { font-size: 28px; margin-bottom: 10px; color: #333; }
        .order-number { font-size: 20px; color: #666; margin-bottom: 10px; }
        .order-total { font-size: 36px; font-weight: bold; color: #000; margin-bottom: 20px; }
        .order-details { text-align: left; background: #f8f9fa; border-radius: 8px; padding: 20px; margin-bottom: 25px; }
        .order-details p { margin-bottom: 8px; font-size: 14px; color: #555; }
        .order-details p strong { color: #333; }
        .btn { display: inline-block; padding: 14px 30px; border-radius: 6px; text-decoration: none; font-weight: bold; font-size: 14px; margin: 5px; }
        .btn-primary { background: #000; color: #fff; }
        .btn-primary:hover { background: #333; }
        .btn-secondary { background: #fff; color: #000; border: 2px solid #000; }
        .btn-secondary:hover { background: #f5f5f5; }
    </style>
</head>
<body>
    <div class="confirmation-card">
        <div class="check-icon">✓</div>
        <h1>Order Confirmed!</h1>
        <p style="color:#888;margin-bottom:20px;">Thank you for your purchase</p>
        <div class="order-number">Order #{{ $order->order_number }}</div>
        <div class="order-total">Rs {{ number_format($order->total_price, 2) }}</div>
        <div class="order-details">
            <p><strong>Name:</strong> {{ $order->name }}</p>
            <p><strong>Email:</strong> {{ $order->email }}</p>
            <p><strong>Address:</strong> {{ $order->address }}, {{ $order->city }}, {{ $order->postal_code }}</p>
            <p><strong>Payment:</strong> Cash on Delivery ({{ ucfirst($order->payment_status) }})</p>
            <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
        </div>
        <a href="{{ route('home') }}" class="btn btn-primary">Continue Shopping</a>
        @auth
            <a href="{{ route('dashboard') }}" class="btn btn-secondary">My Orders</a>
        @endauth
    </div>
</body>
</html>
