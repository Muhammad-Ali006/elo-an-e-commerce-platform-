@extends('admin.layout')

@section('title', 'Edit Product')

@section('content')
    <div class="page-header">
        <h2>Edit: {{ $product->name }}</h2>
        <a href="{{ route('admin.products') }}" class="btn btn-primary">Back</a>
    </div>

    <div class="card">
        <form method="POST" action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-row">
                <div class="form-group">
                    <label>Product Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
                    @error('name') <small style="color:#dc3545;">{{ $message }}</small> @enderror
                </div>
                <div class="form-group">
                    <label>Category</label>
                    <select name="category_id" class="form-control" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->hierarchy_name ?? $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <small style="color:#dc3545;">{{ $message }}</small> @enderror
                </div>
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea name="description" class="form-control" required>{{ old('description', $product->description) }}</textarea>
                @error('description') <small style="color:#dc3545;">{{ $message }}</small> @enderror
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Price ($)</label>
                    <input type="number" step="0.01" min="0" name="price" class="form-control" value="{{ old('price', $product->price) }}" required>
                    @error('price') <small style="color:#dc3545;">{{ $message }}</small> @enderror
                </div>
                <div class="form-group">
                    <label>Sale Price ($) <small style="color:#888;">(optional, must be less than price)</small></label>
                    <input type="number" step="0.01" min="0" name="sale_price" class="form-control" value="{{ old('sale_price', $product->sale_price) }}">
                    @error('sale_price') <small style="color:#dc3545;">{{ $message }}</small> @enderror
                </div>
                <div class="form-group">
                    <label>Stock</label>
                    <input type="number" min="0" name="stock" class="form-control" value="{{ old('stock', $product->stock) }}" required>
                    @error('stock') <small style="color:#dc3545;">{{ $message }}</small> @enderror
                </div>
            </div>
            <div class="form-group">
                <label>Product Image</label>
                @if($product->image)
                    <div style="margin-bottom: 10px;">
                        <img src="{{ asset('storage/' . $product->image) }}" style="width:100px;height:100px;object-fit:cover;border-radius:6px;">
                    </div>
                @endif
                <input type="file" name="image" class="form-control" accept="image/*">
                @error('image') <small style="color:#dc3545;">{{ $message }}</small> @enderror
            </div>
            <div class="form-group">
                <label>Gallery Images</label>
                @if($product->images->count() > 0)
                    <div style="display:flex;flex-wrap:wrap;gap:10px;margin-bottom:10px;">
                        @foreach($product->images as $img)
                            <div style="position:relative;">
                                <img src="{{ asset('storage/' . $img->image) }}" style="width:80px;height:80px;object-fit:cover;border-radius:4px;">
                                <form method="POST" action="{{ route('admin.products.delete-image', $img->id) }}" style="position:absolute;top:-6px;right:-6px;" onsubmit="return confirm('Delete this image?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background:#dc3545;color:#fff;border:none;border-radius:50%;width:20px;height:20px;cursor:pointer;font-size:12px;display:flex;align-items:center;justify-content:center;">x</button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                @endif
                <input type="file" name="gallery_images[]" class="form-control" accept="image/*" multiple>
                @error('gallery_images') <small style="color:#dc3545;">{{ $message }}</small> @enderror
            </div>
            <button type="submit" class="btn btn-success">Update Product</button>
        </form>
    </div>
@endsection
