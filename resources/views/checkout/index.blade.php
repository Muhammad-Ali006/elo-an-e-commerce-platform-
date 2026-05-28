<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Elo</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Arial', sans-serif; background: #f5f5f5; }
        .navbar { background: #000; color: #fff; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; }
        .navbar h1 { font-size: 24px; font-weight: bold; }
        .navbar a { color: #fff; text-decoration: none; padding: 8px 15px; border-radius: 4px; }
        .navbar a:hover { background: #333; }
        .container { max-width: 1200px; margin: 0 auto; padding: 30px 20px; }
        .page-title { font-size: 32px; font-weight: bold; margin-bottom: 30px; color: #333; }
        .checkout-layout { display: grid; grid-template-columns: 1fr 400px; gap: 30px; }
        .checkout-form { background: #fff; border-radius: 8px; padding: 30px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 6px; font-weight: bold; font-size: 14px; color: #555; }
        .form-control { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px; transition: border 0.3s; }
        .form-control:focus { outline: none; border-color: #000; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .order-summary { background: #fff; border-radius: 8px; padding: 25px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); height: fit-content; position: sticky; top: 20px; }
        .summary-title { font-size: 22px; font-weight: bold; margin-bottom: 20px; color: #333; }
        .summary-item { display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #eee; font-size: 14px; }
        .summary-total { display: flex; justify-content: space-between; padding-top: 15px; font-size: 22px; font-weight: bold; border-top: 2px solid #000; margin-top: 10px; }
        .place-order-btn { width: 100%; background: #000; color: #fff; border: none; padding: 16px; font-size: 16px; font-weight: bold; border-radius: 6px; cursor: pointer; margin-top: 20px; }
        .place-order-btn:hover { background: #333; }
        .alert { padding: 15px 20px; border-radius: 6px; margin-bottom: 20px; font-size: 14px; }
        .alert-error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .back-link { display: inline-block; color: #666; text-decoration: none; margin-bottom: 20px; font-size: 14px; }
        .back-link:hover { color: #000; }
        @media (max-width: 768px) { .checkout-layout { grid-template-columns: 1fr; } .form-row { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
    <nav class="navbar">
        <h1>elo</h1>
        <div>
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('cart.index') }}">Cart</a>
        </div>
    </nav>
    <div class="container">
        <a href="{{ route('cart.index') }}" class="back-link">← Back to Cart</a>
        <h1 class="page-title">Checkout</h1>

        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        <div class="checkout-layout">
            <div class="checkout-form">
                <form method="POST" action="{{ route('checkout.place') }}">
                    @csrf
                    <div class="form-row">
                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', auth()->user()->name ?? '') }}" required>
                            @error('name') <small style="color:#dc3545;">{{ $message }}</small> @enderror
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', auth()->user()->email ?? '') }}" required>
                            @error('email') <small style="color:#dc3545;">{{ $message }}</small> @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" required>
                        @error('phone') <small style="color:#dc3545;">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" name="address" class="form-control" value="{{ old('address') }}" required>
                        @error('address') <small style="color:#dc3545;">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>City</label>
                            <input type="text" name="city" class="form-control" value="{{ old('city') }}" required>
                            @error('city') <small style="color:#dc3545;">{{ $message }}</small> @enderror
                        </div>
                        <div class="form-group">
                            <label>Postal Code</label>
                            <input type="text" name="postal_code" class="form-control" value="{{ old('postal_code') }}" required>
                            @error('postal_code') <small style="color:#dc3545;">{{ $message }}</small> @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Country</label>
                            <select name="country" class="form-control" required>
                                <option value="US" {{ old('country') === 'US' ? 'selected' : '' }}>United States</option>
                                <option value="CA" {{ old('country') === 'CA' ? 'selected' : '' }}>Canada</option>
                                <option value="GB" {{ old('country') === 'GB' ? 'selected' : '' }}>United Kingdom</option>
                                <option value="AU" {{ old('country') === 'AU' ? 'selected' : '' }}>Australia</option>
                                <option value="DE" {{ old('country') === 'DE' ? 'selected' : '' }}>Germany</option>
                                <option value="FR" {{ old('country') === 'FR' ? 'selected' : '' }}>France</option>
                                <option value="IN" {{ old('country') === 'IN' ? 'selected' : '' }}>India</option>
                                <option value="PK" {{ old('country') === 'PK' ? 'selected' : '' }}>Pakistan</option>
                            </select>
                            @error('country') <small style="color:#dc3545;">{{ $message }}</small> @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Payment Method</label>
                        <div style="background:#f9f9f9;border:1px solid #ddd;border-radius:6px;padding:15px;display:flex;align-items:center;gap:12px;">
                            <input type="radio" name="payment_method" value="cod" checked id="cod" style="width:18px;height:18px;">
                            <label for="cod" style="margin:0;cursor:pointer;font-weight:bold;">Cash on Delivery (COD)</label>
                        </div>
                        <small style="color:#888;display:block;margin-top:6px;">Pay when you receive your order. No online payment required.</small>
                    </div>
                    <button type="submit" class="place-order-btn">Place Order</button>
                </form>
            </div>
            <div class="order-summary">
                <h2 class="summary-title">Order Summary</h2>
                @foreach($cart as $id => $item)
                    <div class="summary-item">
                        <span>{{ $item['name'] }} × {{ $item['quantity'] }}</span>
                        <span>Rs {{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                    </div>
                @endforeach
                <div class="summary-item">
                    <span>Shipping</span>
                    <span>Free</span>
                </div>
                <div class="summary-total">
                    <span>Total</span>
                    <span>Rs {{ number_format($total, 2) }}</span>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
