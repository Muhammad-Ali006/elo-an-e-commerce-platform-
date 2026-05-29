<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop - Elo</title>
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
        }
        .navbar-links a:hover {
            background: #333;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 30px 20px;
        }
        .search-filter-bar {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }
        .search-form {
            display: flex;
            gap: 10px;
            margin-bottom: 15px;
        }
        .search-form input {
            flex: 1;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }
        .search-form button {
            background: #000;
            color: #fff;
            border: none;
            padding: 12px 30px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }
        .search-form button:hover {
            background: #333;
        }
        .category-filters {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }
        .category-btn {
            padding: 8px 16px;
            background: #f0f0f0;
            border: 1px solid #ddd;
            border-radius: 20px;
            text-decoration: none;
            color: #333;
            font-size: 14px;
            transition: all 0.3s;
        }
        .category-btn:hover {
            background: #e0e0e0;
        }
        .category-btn.active {
            background: #000;
            color: #fff;
            border-color: #000;
        }
        .sale-badge {
            background: #dc3545;
            color: #fff;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
            position: absolute;
            top: 10px;
            left: 10px;
            z-index: 2;
        }
        .product-image {
            position: relative;
        }
        .original-price {
            text-decoration: line-through;
            color: #888;
            font-size: 14px;
            font-weight: normal;
            margin-right: 8px;
        }
        .sale-price {
            color: #dc3545;
        }
        .product-image {
            width: 100%;
            height: 250px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 18px;
            font-weight: bold;
            position: relative;
        }
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 25px;
            margin-bottom: 30px;
        }
        .product-card {
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.15);
        }
        .product-info {
            padding: 15px;
        }
        .product-category {
            font-size: 12px;
            color: #888;
            text-transform: uppercase;
            margin-bottom: 5px;
        }
        .product-name {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 8px;
            color: #333;
            text-decoration: none;
            display: block;
        }
        .product-name:hover {
            color: #000;
        }
        .product-description {
            font-size: 14px;
            color: #666;
            margin-bottom: 12px;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .product-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .product-price {
            font-size: 22px;
            font-weight: bold;
            color: #000;
        }
        .product-stock {
            font-size: 12px;
            color: #28a745;
        }
        .no-products {
            text-align: center;
            padding: 60px 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }
        .no-products h2 {
            font-size: 24px;
            color: #666;
            margin-bottom: 10px;
        }
        .pagination {
            margin-top: 30px;
        }
        .pagination-inner {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }
        .page-link {
            padding: 4px 10px;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 4px;
            text-decoration: none;
            color: #333;
            font-size: 13px;
            min-width: 28px;
            text-align: center;
            display: inline-block;
        }
        .page-link:hover { background: #f0f0f0; }
        .page-link.active { background: #000; color: #fff; border-color: #000; cursor: default; }
        .page-link.disabled { color: #ccc; cursor: default; }
        .page-link.disabled:hover { background: #fff; }
        .page-link.page-arrow { padding: 4px 4px; min-width: 20px; }
        .page-arrow-icon { width: 8px; height: 8px; display: block; }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar">
        <h1>elo</h1>
        <div class="navbar-links">
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('products.index') }}">Shop</a>
            @auth
                <a href="{{ route('dashboard') }}">Dashboard</a>
            @else
                <a href="{{ route('login') }}">Login</a>
            @endauth
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container">
        <!-- Search & Filter Bar -->
        <div class="search-filter-bar">
            <form action="{{ route('products.index') }}" method="GET" class="search-form">
                <input 
                    type="text" 
                    name="search" 
                    placeholder="Search products..." 
                    value="{{ $search ?? '' }}"
                >
                <button type="submit">Search</button>
            </form>

            <div class="category-filters">
                <a href="{{ route('products.index') }}" 
                   class="category-btn {{ !$categoryId ? 'active' : '' }}">
                    All Products
                </a>
                @php
                    $categoryImages = [
                        'Clothing' => 'photo-1490481651871-ab68de25d43d',
                        'Men' => 'photo-1593030761757-71fae45fa0e7',
                        'Women' => 'photo-1595777457583-95e059d581b8',
                        'Kids' => 'photo-1622290291468-a28f7a7dc6a8',
                        'Electronics' => 'photo-1498049794561-7780e7231661',
                        'Books' => 'photo-1495446815901-a7297e633e8d',
                        'Home' => 'photo-1484101403633-562f891dc89a',
                        'Sports' => 'photo-1571019613454-1cb2f99b2d8b',
                        'Beauty' => 'photo-1596462502278-27bfdc403348',
                        'Accessories' => 'photo-1508427953056-00e3b5ed3d40',
                    ];
                @endphp
                @foreach($categories as $category)
                    <a href="{{ route('products.index', ['category' => $category->id]) }}" 
                       class="category-btn {{ $categoryId == $category->id ? 'active' : '' }}">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Products Grid -->
        @if($products->count() > 0)
            <div class="products-grid">
                @foreach($products as $product)
                    @php
                        $catKey = $product->category->name;
                        $fallbackPhoto = $categoryImages[$catKey] ?? 'photo-1490481651871-ab68de25d43d';
                    @endphp
                    <div class="product-card">
                        <a href="{{ route('products.show', $product->id) }}">
                            <div class="product-image" style="background-image: url('{{ $product->image ? asset('storage/'.$product->image) : 'https://images.unsplash.com/'.$fallbackPhoto.'?w=400&h=500&fit=crop' }}'); background-size: cover; background-position: center;">
                                @if($product->is_on_sale)
                                    <div class="sale-badge">-{{ $product->discount_percent }}%</div>
                                @endif
                            </div>
                        </a>
                        <div class="product-info">
                            <div class="product-category">{{ $product->category->name }}</div>
                            <a href="{{ route('products.show', $product->id) }}" class="product-name" style="text-decoration:none;color:inherit;">{{ $product->name }}</a>
                            <div class="product-description">{{ $product->description }}</div>
                            <div class="product-footer">
                                <div class="product-price">
                                    @if($product->is_on_sale)
                                        <span class="original-price">Rs {{ number_format($product->price, 2) }}</span>
                                        <span class="sale-price">Rs {{ number_format($product->sale_price, 2) }}</span>
                                    @else
                                        Rs {{ number_format($product->price, 2) }}
                                    @endif
                                </div>
                                <form method="POST" action="{{ route('cart.add', $product->id) }}" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="add-to-cart-btn" {{ $product->stock == 0 ? 'disabled' : '' }} style="background:#000;color:#fff;border:none;padding:8px 16px;border-radius:4px;cursor:pointer;font-size:13px;font-weight:bold;">{{ $product->stock > 0 ? 'Add to Cart' : 'Out of Stock' }}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="pagination">
                {{ $products->withQueryString()->links() }}
            </div>
        @else
            <div class="no-products">
                <h2>No products found</h2>
                <p>Try adjusting your search or filters</p>
            </div>
        @endif
    </div>
</body>
</html>