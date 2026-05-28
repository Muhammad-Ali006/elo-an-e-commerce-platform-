<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elo - Premium Fashion</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Arial', sans-serif; background: #fafafa; color: #333; }
        .navbar { background: #000; color: #fff; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; z-index: 100; }
        .navbar h1 { font-size: 24px; font-weight: bold; }
        .navbar-links { display: flex; gap: 20px; align-items: center; }
        .navbar-links a { color: #fff; text-decoration: none; padding: 8px 15px; border-radius: 4px; transition: background 0.3s; font-size: 14px; }
        .navbar-links a:hover { background: #333; }
        .navbar-links .cart-badge { background: #dc3545; color: #fff; border-radius: 50%; padding: 2px 8px; font-size: 12px; margin-left: 4px; }
        .hero { background: linear-gradient(135deg, #1a1a1a 0%, #333 100%); color: #fff; padding: 100px 40px; text-align: center; }
        .hero h1 { font-size: 56px; font-weight: bold; margin-bottom: 20px; letter-spacing: 1px; }
        .hero p { font-size: 20px; color: #ccc; margin-bottom: 40px; max-width: 600px; margin-left: auto; margin-right: auto; line-height: 1.6; }
        .hero .btn { background: #fff; color: #000; padding: 16px 40px; border-radius: 6px; text-decoration: none; font-weight: bold; font-size: 16px; display: inline-block; transition: transform 0.3s; }
        .hero .btn:hover { transform: translateY(-2px); }
        .container { max-width: 1200px; margin: 0 auto; padding: 60px 20px; }
        .section-title { font-size: 32px; font-weight: bold; margin-bottom: 40px; text-align: center; color: #333; }
        .categories-grid { display: grid; grid-template-columns: repeat(5, 1fr); gap: 20px; margin-bottom: 60px; }
        @media (max-width: 900px) { .categories-grid { grid-template-columns: repeat(3, 1fr); } }
        @media (max-width: 600px) { .categories-grid { grid-template-columns: repeat(2, 1fr); } }
        .category-card { background: #fff; border-radius: 12px; padding: 30px; text-align: center; box-shadow: 0 2px 10px rgba(0,0,0,0.06); text-decoration: none; color: inherit; transition: transform 0.3s, box-shadow 0.3s; }
        .category-card:hover { transform: translateY(-4px); box-shadow: 0 6px 20px rgba(0,0,0,0.1); }
        .category-card .icon { font-size: 40px; margin-bottom: 15px; }
        .category-card h3 { font-size: 18px; margin-bottom: 8px; }
        .category-card p { color: #888; font-size: 14px; }
        .products-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(270px, 1fr)); gap: 25px; margin-bottom: 60px; }
        .product-card { background: #fff; border-radius: 10px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.06); text-decoration: none; color: inherit; transition: transform 0.3s, box-shadow 0.3s; display: block; }
        .product-card:hover { transform: translateY(-5px); box-shadow: 0 4px 15px rgba(0,0,0,0.12); }
        .product-image { width: 100%; height: 280px; background-size: cover; background-position: center; position: relative; }
        .sale-badge { background: #dc3545; color: #fff; padding: 4px 10px; border-radius: 4px; font-size: 12px; font-weight: bold; position: absolute; top: 12px; left: 12px; }
        .product-info { padding: 16px; }
        .product-category { font-size: 12px; color: #888; text-transform: uppercase; margin-bottom: 4px; }
        .product-name { font-size: 16px; font-weight: bold; margin-bottom: 8px; color: #333; }
        .product-footer { display: flex; justify-content: space-between; align-items: center; }
        .product-price { font-size: 18px; font-weight: bold; color: #000; }
        .original-price { text-decoration: line-through; color: #888; font-size: 14px; font-weight: normal; margin-right: 6px; }
        .sale-price { color: #dc3545; }
        .sale-section { background: linear-gradient(135deg, #2d2d2d 0%, #1a1a1a 100%); padding: 60px 40px; margin: 60px auto; border-radius: 12px; text-align: center; color: #fff; }
        .sale-section h2 { font-size: 36px; margin-bottom: 12px; }
        .sale-section p { color: #ccc; font-size: 16px; margin-bottom: 30px; }
        .sale-section .btn { background: #dc3545; color: #fff; padding: 14px 36px; border-radius: 6px; text-decoration: none; font-weight: bold; display: inline-block; }
        .sale-section .btn:hover { background: #c82333; }
        .cta-section { background: #000; color: #fff; padding: 80px 40px; text-align: center; }
        .cta-section h2 { font-size: 38px; margin-bottom: 16px; }
        .cta-section p { color: #aaa; font-size: 18px; margin-bottom: 30px; }
        .cta-section .btn { background: #fff; color: #000; padding: 16px 40px; border-radius: 6px; text-decoration: none; font-weight: bold; display: inline-block; }
        .footer { background: #111; color: #888; padding: 40px; text-align: center; font-size: 14px; }
        .footer a { color: #aaa; text-decoration: none; }
        .footer a:hover { color: #fff; }
        @media (max-width: 768px) {
            .hero { padding: 60px 20px; }
            .hero h1 { font-size: 32px; }
            .hero p { font-size: 16px; }
            .container { padding: 30px 15px; }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <h1>elo</h1>
        <div class="navbar-links">
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('products.index') }}">Shop</a>
            <a href="{{ route('cart.index') }}">Cart
                @if(session('cart'))
                    <span class="cart-badge">{{ array_sum(array_column(session('cart'), 'quantity')) }}</span>
                @endif
            </a>
            @auth
                @if(auth()->user()->is_admin)
                    <a href="{{ route('admin.dashboard') }}">Admin</a>
                @endif
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit" style="background:none;border:none;color:#fff;cursor:pointer;padding:8px 15px;font-size:14px;">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}">Login</a>
            @endauth
        </div>
    </nav>

    <section class="hero">
        <h1>Elevate Your Style</h1>
        <p>Discover premium fashion that defines who you are. From timeless classics to the latest trends, find everything you need at Elo.</p>
        <a href="{{ route('products.index') }}" class="btn">Shop Now</a>
    </section>

    <div class="container">
        @if($categories->count() > 0)
            <h2 class="section-title">Shop by Category</h2>
            <div class="categories-grid">
                @foreach($categories as $category)
                    <a href="{{ route('products.index', ['category' => $category->id]) }}" class="category-card">
                        <div class="icon">
                            @if($category->name == 'Clothing')
                                <span style="font-size:40px;">Clothing</span>
                            @elseif($category->name == 'Electronics')
                                <span style="font-size:40px;">Electronics</span>
                            @elseif($category->name == 'Books')
                                <span style="font-size:40px;">Books</span>
                            @elseif($category->name == 'Home & Kitchen')
                                <span style="font-size:40px;">Home</span>
                            @elseif($category->name == 'Sports & Outdoors')
                                <span style="font-size:40px;">Sports</span>
                            @else
                                <span style="font-size:40px;">Shop</span>
                            @endif
                        </div>
                        <h3>{{ $category->name }}</h3>
                        <p>{{ $category->products_count }} Products</p>
                    </a>
                @endforeach
            </div>
        @endif

        <h2 class="section-title">Featured Products</h2>
        <div class="products-grid">
            @forelse($featuredProducts as $product)
                <a href="{{ route('products.show', $product->id) }}" class="product-card">
                    <div class="product-image" style="background-image: url('{{ $product->image ? asset('storage/'.$product->image) : 'https://images.unsplash.com/photo-1490481651871-ab68de25d43d?w=400&h=500&fit=crop' }}');">
                        @if($product->is_on_sale)
                            <div class="sale-badge">-{{ $product->discount_percent }}%</div>
                        @endif
                    </div>
                    <div class="product-info">
                        <div class="product-category">{{ $product->category->name }}</div>
                        <div class="product-name">{{ $product->name }}</div>
                        <div class="product-footer">
                            <div class="product-price">
                                @if($product->is_on_sale)
                                    <span class="original-price">Rs {{ number_format($product->price) }}</span>
                                    <span class="sale-price">Rs {{ number_format($product->sale_price) }}</span>
                                @else
                                    Rs {{ number_format($product->price) }}
                                @endif
                            </div>
                        </div>
                    </div>
                </a>
            @empty
                <p style="grid-column:1/-1;text-align:center;color:#888;padding:40px;">No products yet.</p>
            @endforelse
        </div>
    </div>

    @if($saleProducts->count() > 0)
        <div class="sale-section" style="max-width:1200px;margin:0 auto 60px;">
            <h2>Flash Sale</h2>
            <p>Limited time offers on premium products. Grab them before they're gone.</p>
            <div class="products-grid" style="margin-bottom:0;">
                @foreach($saleProducts as $product)
                    <a href="{{ route('products.show', $product->id) }}" class="product-card" style="background:#3a3a3a;color:#fff;">
                        <div class="product-image" style="background-image: url('{{ $product->image ? asset('storage/'.$product->image) : 'https://images.unsplash.com/photo-1490481651871-ab68de25d43d?w=400&h=500&fit=crop' }}');">
                            <div class="sale-badge">-{{ $product->discount_percent }}%</div>
                        </div>
                        <div class="product-info">
                            <div class="product-category" style="color:#aaa;">{{ $product->category->name }}</div>
                            <div class="product-name" style="color:#fff;">{{ $product->name }}</div>
                            <div class="product-footer">
                                <div class="product-price">
                                    <span class="original-price" style="color:#888;">Rs {{ number_format($product->price) }}</span>
                                    <span class="sale-price">Rs {{ number_format($product->sale_price) }}</span>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif

    <section class="cta-section">
        <h2>Join the elo Community</h2>
        <p>Sign up for exclusive deals, style tips, and early access to new arrivals.</p>
        @guest
            <a href="{{ route('register') }}" class="btn">Create Account</a>
        @else
            <a href="{{ route('products.index') }}" class="btn">Start Shopping</a>
        @endguest
    </section>

    <footer class="footer">
        <p>&copy; {{ date('Y') }} Elo. All rights reserved. | <a href="{{ route('products.index') }}">Shop</a></p>
    </footer>
</body>
</html>
