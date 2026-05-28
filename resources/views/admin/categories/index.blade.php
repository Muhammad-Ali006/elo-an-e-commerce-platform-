@extends('admin.layout')

@section('title', 'Categories')

@section('content')
    <div class="page-header">
        <h2>Categories</h2>
    </div>

    <div class="card">
        <form method="POST" action="{{ route('admin.categories.store') }}" style="display:flex;gap:10px;margin-bottom:25px;align-items:end;">
            @csrf
            <div style="flex:1;">
                <label style="display:block;margin-bottom:6px;font-weight:bold;font-size:14px;color:#555;">New Category Name</label>
                <input type="text" name="name" class="form-control" placeholder="e.g. Electronics" required>
            </div>
            <div style="flex:1;">
                <label style="display:block;margin-bottom:6px;font-weight:bold;font-size:14px;color:#555;">Parent Category</label>
                <select name="parent_id" class="form-control">
                    <option value="">None (top level)</option>
                    @foreach($allCategories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-success">Add Category</button>
        </form>

        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Products</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td><strong>{{ $category->hierarchy_name ?? $category->name }}</strong></td>
                        <td>{{ $category->products_count }}</td>
                        <td>{{ $category->created_at->format('M d, Y') }}</td>
                        <td>
                            <div class="actions">
                                <form method="POST" action="{{ route('admin.categories.update', $category->id) }}" style="display:flex;gap:5px;align-items:center;flex-wrap:wrap;">
                                    @csrf
                                    @method('PUT')
                                    <input type="text" name="name" value="{{ $category->name }}" class="form-control" style="width:120px;padding:6px 10px;" required>
                                    <select name="parent_id" class="form-control" style="width:130px;padding:6px;">
                                        <option value="">Top level</option>
                                        @foreach($allCategories as $cat)
                                            <option value="{{ $cat->id }}" {{ $category->parent_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn btn-warning btn-sm">Update</button>
                                </form>
                                <form method="POST" action="{{ route('admin.categories.destroy', $category->id) }}" onsubmit="return confirm('Delete category {{ addslashes($category->name) }}?')">
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
    </div>
@endsection
