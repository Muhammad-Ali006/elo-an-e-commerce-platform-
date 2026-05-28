@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
    <div class="page-header">
        <h2>Dashboard</h2>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon" style="color:#4a6cf7;">P</div>
            <div class="stat-number">{{ $products_count }}</div>
            <div class="stat-label">Total Products</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="color:#6c5ce7;">C</div>
            <div class="stat-number">{{ $categories_count }}</div>
            <div class="stat-label">Categories</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="color:#00b894;">U</div>
            <div class="stat-number">{{ $users_count }}</div>
            <div class="stat-label">Users</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="color:#fdcb6e;">O</div>
            <div class="stat-number">{{ $orders_count }}</div>
            <div class="stat-label">Orders</div>
        </div>
        <div class="stat-card" style="border: 2px solid {{ $low_stock_count > 0 ? '#dc3545' : '#28a745' }};">
            <div class="stat-icon" style="color: {{ $low_stock_count > 0 ? '#dc3545' : '#28a745' }};">!</div>
            <div class="stat-number" style="color: {{ $low_stock_count > 0 ? '#dc3545' : '#28a745' }};">{{ $low_stock_count }}</div>
            <div class="stat-label">Low Stock Items (&lt;10)</div>
        </div>
    </div>

    @if($low_stock_count > 0)
        <div class="card">
            <h3 style="margin-bottom: 15px; color: #dc3545;">Low Stock Alert</h3>
            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Category</th>
                        <th>Stock</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($low_stock_products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td><span class="badge badge-low-stock">{{ $product->stock }}</span></td>
                            <td><a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-primary btn-sm">Update Stock</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <div class="card">
        <h3 style="margin-bottom: 15px;">Recent Orders</h3>
        @if($recent_orders->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>Order #</th>
                        <th>Customer</th>
                        <th>Total</th>
                        <th>Payment</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recent_orders as $order)
                        <tr>
                            <td><a href="{{ route('admin.orders.show', $order->id) }}">{{ $order->order_number }}</a></td>
                            <td>{{ $order->name }}</td>
                            <td>Rs {{ number_format($order->total_price, 2) }}</td>
                            <td><span class="badge badge-{{ $order->payment_status }}">COD</span></td>
                            <td><span class="badge badge-{{ $order->status }}">{{ ucfirst($order->status) }}</span></td>
                            <td>{{ $order->created_at->format('M d, Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p style="color: #888;">No orders yet.</p>
        @endif
    </div>
@endsection
