@extends('admin.layout')

@section('title', 'Products')

@section('content')
    <div class="page-header">
        <h2>Products</h2>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">+ Add Product</a>
    </div>

    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" class="table-img">
                            @else
                                <div class="table-img" style="display:flex;align-items:center;justify-content:center;color:#888;font-size:18px;font-weight:bold;">IMG</div>
                            @endif
                        </td>
                        <td><strong>{{ $product->name }}</strong></td>
                        <td>{{ $product->category->name }}</td>
                        <td>
                            @if($product->is_on_sale)
                                <span style="text-decoration:line-through;color:#888;">Rs {{ number_format($product->price, 2) }}</span>
                                <span style="color:#dc3545;font-weight:bold;">Rs {{ number_format($product->sale_price, 2) }}</span>
                                <span class="badge badge-low-stock" style="margin-left:4px;">-{{ $product->discount_percent }}%</span>
                            @else
                                Rs {{ number_format($product->price, 2) }}
                            @endif
                        </td>
                        <td>
                            <span class="badge {{ $product->stock < 10 ? 'badge-low-stock' : 'badge-in-stock' }}">
                                {{ $product->stock }}
                            </span>
                        </td>
                        <td>
                            <div class="actions">
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form method="POST" action="{{ route('admin.products.destroy', $product->id) }}" onsubmit="return confirm('Delete this product?')">
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
        <div class="pagination">
            {{ $products->links() }}
        </div>
    </div>
@endsection
