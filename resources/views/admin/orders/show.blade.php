@extends('admin.layout')

@section('title', 'Order ' . $order->order_number)

@section('content')
    <div class="page-header">
        <h2>Order {{ $order->order_number }}</h2>
        <a href="{{ route('admin.orders') }}" class="btn btn-primary">← All Orders</a>
    </div>

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:25px;">
        <div class="card">
            <h3 style="margin-bottom:15px;">Customer Details</h3>
            <table>
                <tr><td style="width:120px;font-weight:bold;">Name</td><td>{{ $order->name }}</td></tr>
                <tr><td style="font-weight:bold;">Email</td><td>{{ $order->email }}</td></tr>
                <tr><td style="font-weight:bold;">Phone</td><td>{{ $order->phone }}</td></tr>
                <tr><td style="font-weight:bold;">Address</td><td>{{ $order->address }}</td></tr>
                <tr><td style="font-weight:bold;">City</td><td>{{ $order->city }}</td></tr>
                <tr><td style="font-weight:bold;">Postal Code</td><td>{{ $order->postal_code }}</td></tr>
                <tr><td style="font-weight:bold;">Country</td><td>{{ $order->country }}</td></tr>
            </table>
        </div>

        <div class="card">
            <h3 style="margin-bottom:15px;">Order Status</h3>
            <p style="font-size:24px;font-weight:bold;margin-bottom:15px;">
                <span class="badge badge-{{ $order->status }}" style="font-size:16px;padding:8px 16px;">{{ ucfirst($order->status) }}</span>
            </p>
            <div style="margin-bottom:15px;padding:12px;background:#f9f9f9;border-radius:6px;">
                <p style="font-size:14px;color:#555;"><strong>Payment:</strong> Cash on Delivery (COD)</p>
                <p style="font-size:14px;color:#555;"><strong>Payment Status:</strong> <span class="badge badge-{{ $order->payment_status }}">{{ ucfirst($order->payment_status) }}</span></p>
            </div>
            <form method="POST" action="{{ route('admin.orders.update-status', $order->id) }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Update Status</label>
                    <div style="display:flex;gap:10px;">
                        <select name="status" class="form-control" style="flex:1;">
                            <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Shipped</option>
                            <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>Delivered</option>
                            <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </div>
            </form>
            <p style="margin-top:10px;font-size:13px;color:#888;">Order placed: {{ $order->created_at->format('F d, Y \a\t g:i A') }}</p>
        </div>
    </div>

    <div class="card" style="margin-top:25px;">
        <h3 style="margin-bottom:15px;">Order Items</h3>
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                    <tr>
                        <td><strong>{{ $item->product_name }}</strong></td>
                        <td>Rs {{ number_format($item->product_price, 2) }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td><strong>Rs {{ number_format($item->subtotal, 2) }}</strong></td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" style="text-align:right;font-weight:bold;font-size:18px;">Total:</td>
                    <td style="font-weight:bold;font-size:18px;">Rs {{ number_format($order->total_price, 2) }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
@endsection
