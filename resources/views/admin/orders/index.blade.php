@extends('admin.layout')

@section('title', 'Orders')

@section('content')
    <div class="page-header">
        <h2>Orders</h2>
    </div>

    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>Order #</th>
                    <th>Customer</th>
                    <th>Email</th>
                    <th>Total</th>
                    <th>Items</th>
                    <th>Payment</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td><strong>{{ $order->order_number }}</strong></td>
                        <td>{{ $order->name }}</td>
                        <td>{{ $order->email }}</td>
                        <td><strong>Rs {{ number_format($order->total_price, 2) }}</strong></td>
                        <td>{{ $order->items->sum('quantity') }}</td>
                        <td><span class="badge badge-{{ $order->payment_status }}">{{ ucfirst($order->payment_method) }}</span></td>
                        <td><span class="badge badge-{{ $order->status }}">{{ ucfirst($order->status) }}</span></td>
                        <td>{{ $order->created_at->format('M d, Y') }}</td>
                        <td>
                            <div class="actions">
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-primary btn-sm">View</a>
                                <form method="POST" action="{{ route('admin.orders.destroy', $order->id) }}" onsubmit="return confirm('Delete order {{ $order->order_number }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination">{{ $orders->links() }}</div>
    </div>
@endsection
