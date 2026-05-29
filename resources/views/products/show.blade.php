<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} - Elo</title>
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
        .back-link {
            display: inline-block;
            color: #666;
            text-decoration: none;
            margin-bottom: 20px;
            font-size: 14px;
        }
        .back-link:hover {
            color: #000;
        }
        .product-detail {
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            margin-bottom: 40px;
        }
        .product-main {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            padding: 40px;
        }
        .product-image-large {
            width: 100%;
            height: 500px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 80px;
            font-weight: bold;
            border-radius: 8px;
        }
        .product-info-section {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        .category-badge {
            display: inline-block;
            background: #f0f0f0;
            color: #666;
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 12px;
            text-transform: uppercase;
            font-weight: bold;
            width: fit-content;
        }
        .product-title {
            font-size: 36px;
            font-weight: bold;
            color: #333;
            line-height: 1.2;
        }
        .product-price-large {
            font-size: 42px;
            font-weight: bold;
            color: #000;
        }
        .product-description-full {
            font-size: 16px;
            color: #666;
            line-height: 1.6;
        }
        .product-meta {
            display: flex;
            gap: 30px;
            padding: 20px 0;
            border-top: 1px solid #eee;
            border-bottom: 1px solid #eee;
        }
        .meta-item {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }
        .meta-label {
            font-size: 12px;
            color: #888;
            text-transform: uppercase;
        }
        .meta-value {
            font-size: 16px;
            color: #333;
            font-weight: bold;
        }
        .stock-available {
            color: #28a745;
        }
        .stock-low {
            color: #ffc107;
        }
        .stock-out {
            color: #dc3545;
        }
        .sale-badge-large {
            background: #dc3545;
            color: #fff;
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 14px;
            font-weight: bold;
            display: inline-block;
            margin-bottom: 10px;
        }
        .original-price-large {
            text-decoration: line-through;
            color: #888;
            font-size: 24px;
            font-weight: normal;
            margin-right: 10px;
        }
        .sale-price-large {
            color: #dc3545;
        }
        .add-to-cart-btn {
            background: #000;
            color: #fff;
            border: none;
            padding: 18px 40px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.3s;
            width: 100%;
        }
        .add-to-cart-btn:hover {
            background: #333;
        }

        .add-to-cart-btn:disabled {
            background: #ccc;
            cursor: not-allowed;
        }
        .related-section {
            margin-top: 60px;
        }
        .related-title {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #333;
        }
        .related-products {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }
        .related-product-card {
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            transition: transform 0.3s;
            text-decoration: none;
            color: inherit;
            display: block;
        }
        .related-product-card:hover {
            transform: translateY(-5px);
        }
        .related-product-image {
            width: 100%;
            height: 200px;
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 40px;
            font-weight: bold;
        }
        .related-product-info {
            padding: 15px;
        }
        .related-product-name {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 8px;
        }
        .related-product-price {
            font-size: 18px;
            font-weight: bold;
            color: #000;
        }
        .related-original-price {
            text-decoration: line-through;
            color: #888;
            font-size: 14px;
            font-weight: normal;
            margin-right: 6px;
        }
        .related-sale-price {
            color: #dc3545;
        }
        .related-sale-badge {
            background: #dc3545;
            color: #fff;
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 10px;
            font-weight: bold;
            margin-left: 6px;
        }
        @media (max-width: 768px) {
            .product-main {
                grid-template-columns: 1fr;
                padding: 20px;
            }
            .product-image-large {
                height: 300px;
                font-size: 60px;
            }
            .product-title {
                font-size: 28px;
            }
            .product-price-large {
                font-size: 32px;
            }
        }
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
        @php
            $catImages = [
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
            $catKey = $product->category->name;
            $fallbackPhoto = $catImages[$catKey] ?? 'photo-1490481651871-ab68de25d43d';
        @endphp
        <a href="{{ route('products.index') }}" class="back-link">← Back to Shop</a>

        <!-- Product Detail -->
        <div class="product-detail">
            <div class="product-main">
                <!-- Product Image -->
                <div class="product-image-large" style="background-image: url('{{ $product->image ? asset('storage/'.$product->image) : 'https://images.unsplash.com/'.$fallbackPhoto.'?w=800&h=800&fit=crop' }}'); background-size: cover; background-position: center;">
                </div>

                <!-- Product Information -->
                <div class="product-info-section">
                    <span class="category-badge">{{ $product->category->name }}</span>
                    
                    <h1 class="product-title">{{ $product->name }}</h1>
                    
                    @if($product->is_on_sale)
                        <div class="sale-badge-large">Sale -{{ $product->discount_percent }}%</div>
                        <div class="product-price-large">
                            <span class="original-price-large">Rs {{ number_format($product->price, 2) }}</span>
                            <span class="sale-price-large">Rs {{ number_format($product->sale_price, 2) }}</span>
                        </div>
                    @else
                        <div class="product-price-large">Rs {{ number_format($product->price, 2) }}</div>
                    @endif
                    
                    <p class="product-description-full">{{ $product->description }}</p>
                    
                    <div class="product-meta">
                        <div class="meta-item">
                            <span class="meta-label">Availability</span>
                            <span class="meta-value 
                                @if($product->stock > 10) stock-available
                                @elseif($product->stock > 0) stock-low
                                @else stock-out
                                @endif">
                                @if($product->stock > 0)
                                    {{ $product->stock }} in stock
                                @else
                                    Out of stock
                                @endif
                            </span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-label">Category</span>
                            <span class="meta-value">{{ $product->category->name }}</span>
                        </div>
                    </div>
                    
                    <form method="POST" action="{{ route('cart.add', $product->id) }}">
                        @csrf
                        <button 
                            type="submit"
                            class="add-to-cart-btn" 
                            @if($product->stock == 0) disabled @endif>
                            @if($product->stock > 0)
                                Add to Cart
                            @else
                                Out of Stock
                            @endif
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        @if($relatedProducts->count() > 0)
            <div class="related-section">
                <h2 class="related-title">Related Products</h2>
                <div class="related-products">
                    @foreach($relatedProducts as $related)
                        @php $rKey = $related->category->name; $rPhoto = $catImages[$rKey] ?? 'photo-1490481651871-ab68de25d43d'; @endphp
                        <a href="{{ route('products.show', $related->id) }}" class="related-product-card">
                            <div class="related-product-image" style="background-image: url('{{ $related->image ? asset('storage/'.$related->image) : 'https://images.unsplash.com/'.$rPhoto.'?w=400&h=400&fit=crop' }}'); background-size: cover; background-position: center;">
                            </div>
                            <div class="related-product-info">
                                <div class="related-product-name">{{ $related->name }}</div>
                                <div class="related-product-price">
                                    @if($related->is_on_sale)
                                        <span class="related-original-price">Rs {{ number_format($related->price, 2) }}</span>
                                        <span class="related-sale-price">Rs {{ number_format($related->sale_price, 2) }}</span>
                                        <span class="related-sale-badge">-{{ $related->discount_percent }}%</span>
                                    @else
                                        Rs {{ number_format($related->price, 2) }}
                                    @endif
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</body>
</html>