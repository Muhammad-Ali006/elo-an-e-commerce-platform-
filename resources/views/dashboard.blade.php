<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Elo</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Arial', sans-serif; background: #f5f5f5; }
        .navbar { background: #000; color: #fff; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; }
        .navbar h1 { font-size: 24px; font-weight: bold; }
        .navbar-links a { color: #fff; text-decoration: none; padding: 8px 15px; border-radius: 4px; }
        .navbar-links a:hover { background: #333; }
        .container { max-width: 900px; margin: 0 auto; padding: 30px 20px; }
        .page-title { font-size: 32px; font-weight: bold; margin-bottom: 10px; color: #333; }
        .welcome-sub { color: #888; margin-bottom: 30px; }
        .card { background: #fff; border-radius: 8px; padding: 25px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); margin-bottom: 20px; }
        .card h3 { margin-bottom: 15px; color: #444; }
        .logout-form { margin-top: 20px; }
        .btn { padding: 10px 20px; border-radius: 6px; border: none; cursor: pointer; font-size: 14px; font-weight: bold; text-decoration: none; display: inline-block; }
        .btn-dark { background: #000; color: #fff; }
        .btn-dark:hover { background: #333; }
        .btn-outline { background: #fff; color: #000; border: 2px solid #000; }
        .btn-outline:hover { background: #f5f5f5; }
        table { width: 100%; border-collapse: collapse; }
        table th { text-align: left; padding: 12px 15px; background: #f8f9fa; color: #555; font-size: 13px; text-transform: uppercase; border-bottom: 2px solid #eee; }
        table td { padding: 12px 15px; border-bottom: 1px solid #eee; font-size: 14px; }
        .badge { display: inline-block; padding: 3px 8px; border-radius: 4px; font-size: 12px; font-weight: bold; }
        .badge-pending { background: #fff3cd; color: #856404; }
        .badge-processing { background: #cce5ff; color: #004085; }
        .badge-shipped { background: #d4edda; color: #155724; }
        .badge-delivered { background: #d4edda; color: #155724; }
        .badge-cancelled { background: #f8d7da; color: #721c24; }
        .admin-link { display: inline-block; margin-top: 20px; padding: 12px 20px; background: #1a1a2e; color: #fff; border-radius: 6px; text-decoration: none; font-weight: bold; }
        .admin-link:hover { background: #16213e; }
        .links { display: flex; gap: 10px; flex-wrap: wrap; margin-bottom: 20px; }
    </style>
</head>
<body>
    <nav class="navbar">
        <h1>elo</h1>
        <div class="navbar-links">
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('products.index') }}">Shop</a>
            <a href="{{ route('cart.index') }}">Cart</a>
        </div>
    </nav>
    <div class="container">
        <h1 class="page-title">Welcome, {{ Auth::user()->name }}!</h1>
        <p class="welcome-sub">Manage your account and orders</p>

        <div class="card">
            <div class="links">
                <a href="{{ route('products.index') }}" class="btn btn-dark">Browse Products</a>
                <a href="{{ route('cart.index') }}" class="btn btn-outline">View Cart</a>
            </div>
            <form action="{{ route('logout') }}" method="POST" class="logout-form">
                @csrf
                <button type="submit" class="btn btn-outline">Logout</button>
            </form>
        </div>

        @if(Auth::user()->is_admin)
            <div class="card" style="border: 2px solid #1a1a2e;">
                <h3>Admin Panel</h3>
                <p style="color:#888;margin-bottom:15px;">You have admin access.</p>
                <a href="{{ route('admin.dashboard') }}" class="admin-link">Go to Admin Dashboard →</a>
            </div>
        @endif

        <div class="card">
            <h3>My Orders</h3>
            @php $orders = Auth::user()->orders()->latest()->get(); @endphp
            @if($orders->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th>Order #</th>
                            <th>Total</th>
                                <th>Payment</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td><strong>{{ $order->order_number }}</strong></td>
                                    <td>Rs {{ number_format($order->total_price, 2) }}</td>
                                    <td><span class="badge badge-{{ $order->payment_status }}">COD</span></td>
                                    <td><span class="badge badge-{{ $order->status }}">{{ ucfirst($order->status) }}</span></td>
                                    <td>{{ $order->created_at->format('M d, Y') }}</td>
                                </tr>
                            @endforeach
                    </tbody>
                </table>
            @else
                <p style="color:#888;">You haven't placed any orders yet.</p>
                <a href="{{ route('products.index') }}" style="display:inline-block;margin-top:10px;color:#000;font-weight:bold;">Start Shopping →</a>
            @endif
        </div>
    </div>
</body>
</html>
