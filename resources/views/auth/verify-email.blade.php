<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email - Elo</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Arial', sans-serif; background: #f5f5f5; display: flex; align-items: center; justify-content: center; min-height: 100vh; }
        .card { background: #fff; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); padding: 40px; max-width: 480px; width: 90%; text-align: center; }
        h1 { font-size: 24px; margin-bottom: 16px; color: #333; }
        p { color: #666; line-height: 1.6; margin-bottom: 24px; font-size: 15px; }
        .btn { display: inline-block; background: #000; color: #fff; padding: 12px 30px; border-radius: 6px; text-decoration: none; font-weight: bold; border: none; cursor: pointer; font-size: 14px; }
        .btn:hover { background: #333; }
        .btn-outline { background: transparent; color: #333; border: 1px solid #ddd; }
        .btn-outline:hover { background: #f0f0f0; }
        .success { color: #28a745; margin-bottom: 16px; font-weight: bold; }
        .resend-form { margin-top: 20px; }
    </style>
</head>
<body>
    <div class="card">
        <h1>Verify Your Email</h1>
        @if(session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif
        <p>Thanks for signing up! Please check your email for a verification link. If you didn't receive it, click below to resend.</p>
        <form action="{{ route('verification.send') }}" method="POST" class="resend-form">
            @csrf
            <button type="submit" class="btn">Resend Verification Email</button>
        </form>
        <form method="POST" action="{{ route('logout') }}" style="margin-top:16px;">
            @csrf
            <button type="submit" class="btn btn-outline">Log Out</button>
        </form>
    </div>
</body>
</html>
