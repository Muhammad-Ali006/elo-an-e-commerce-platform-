<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Elo</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Arial', sans-serif; background: #f5f5f5; display: flex; align-items: center; justify-content: center; min-height: 100vh; }
        .card { background: #fff; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); padding: 40px; max-width: 400px; width: 90%; }
        h1 { text-align: center; font-size: 32px; letter-spacing: 2px; margin-bottom: 6px; }
        h2 { text-align: center; font-size: 22px; color: #333; margin-bottom: 6px; }
        p { text-align: center; color: #888; font-size: 14px; margin-bottom: 24px; }
        .form-group { margin-bottom: 18px; }
        label { display: block; margin-bottom: 6px; font-weight: bold; font-size: 14px; color: #555; }
        input { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px; }
        input:focus { outline: none; border-color: #000; }
        .btn { width: 100%; background: #000; color: #fff; padding: 14px; border-radius: 6px; border: none; font-size: 16px; font-weight: bold; cursor: pointer; }
        .btn:hover { background: #333; }
        .error { color: #dc3545; font-size: 13px; margin-top: 4px; }
        .links { text-align: center; margin-top: 18px; font-size: 14px; }
        .links a { color: #666; text-decoration: none; }
        .links a:hover { color: #000; }
    </style>
</head>
<body>
    <div class="card">
        <h1>elo</h1>
        <h2>Create Account</h2>
        <p>Join Elo for exclusive deals and more</p>

        @if ($errors->any())
            <div class="error">{{ $errors->first() }}</div>
        @endif

        <form action="{{ route('register.process') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="name" value="{{ old('name') }}" required>
                @error('name') <div class="error">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required>
                @error('email') <div class="error">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required minlength="8">
                @error('password') <div class="error">{{ $message }}</div> @enderror
            </div>
            <button type="submit" class="btn">Create Account</button>
        </form>

        <div class="links">
            <a href="{{ route('login') }}">Already have an account? Sign In</a>
        </div>
    </div>
</body>
</html>
