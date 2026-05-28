<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Elo</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Arial', sans-serif; background: #f5f5f5; display: flex; align-items: center; justify-content: center; min-height: 100vh; }
        .card { background: #fff; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); padding: 40px; max-width: 420px; width: 90%; }
        h1 { font-size: 24px; margin-bottom: 24px; color: #333; }
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 6px; font-weight: bold; font-size: 14px; color: #555; }
        input { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px; }
        input:focus { outline: none; border-color: #000; }
        .btn { width: 100%; background: #000; color: #fff; padding: 14px; border-radius: 6px; border: none; font-size: 16px; font-weight: bold; cursor: pointer; }
        .btn:hover { background: #333; }
        .error { color: #dc3545; font-size: 13px; margin-top: 4px; }
    </style>
</head>
<body>
    <div class="card">
        <h1>Reset Password</h1>
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" required>
                @error('email') <div class="error">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label>New Password</label>
                <input type="password" name="password" required minlength="8">
                @error('password') <div class="error">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label>Confirm New Password</label>
                <input type="password" name="password_confirmation" required minlength="8">
            </div>
            <button type="submit" class="btn">Reset Password</button>
        </form>
    </div>
</body>
</html>
