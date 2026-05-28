@extends('admin.layout')

@section('title', 'Add Product')

@section('content')
    <div class="page-header">
        <h2>Add Product</h2>
        <a href="{{ route('admin.products') }}" class="btn btn-primary">Back</a>
    </div>

    <div class="card">
        <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
                <div class="form-group">
                    <label>Product Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                    @error('name') <small style="color:#dc3545;">{{ $message }}</small> @enderror
                </div>
                <div class="form-group">
                    <label>Category</label>
                    <select name="category_id" class="form-control" required>
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->hierarchy_name ?? $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <small style="color:#dc3545;">{{ $message }}</small> @enderror
                </div>
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea name="description" class="form-control" required>{{ old('description') }}</textarea>
                @error('description') <small style="color:#dc3545;">{{ $message }}</small> @enderror
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Price ($)</label>
                    <input type="number" step="0.01" min="0" name="price" class="form-control" value="{{ old('price') }}" required>
                    @error('price') <small style="color:#dc3545;">{{ $message }}</small> @enderror
                </div>
                <div class="form-group">
                    <label>Sale Price ($) <small style="color:#888;">(optional, must be less than price)</small></label>
                    <input type="number" step="0.01" min="0" name="sale_price" class="form-control" value="{{ old('sale_price') }}">
                    @error('sale_price') <small style="color:#dc3545;">{{ $message }}</small> @enderror
                </div>
                <div class="form-group">
                    <label>Stock</label>
                    <input type="number" min="0" name="stock" class="form-control" value="{{ old('stock') }}" required>
                    @error('stock') <small style="color:#dc3545;">{{ $message }}</small> @enderror
                </div>
            </div>
            <div class="form-group">
                <label>Product Image</label>
                <input type="file" name="image" class="form-control" accept="image/*">
                @error('image') <small style="color:#dc3545;">{{ $message }}</small> @enderror
            </div>
            <div class="form-group">
                <label>Gallery Images <small style="color:#888;">(optional, select multiple)</small></label>
                <input type="file" name="gallery_images[]" class="form-control" accept="image/*" multiple>
                @error('gallery_images') <small style="color:#dc3545;">{{ $message }}</small> @enderror
            </div>
            <button type="submit" class="btn btn-success">Create Product</button>
        </form>
    </div>
@endsection
