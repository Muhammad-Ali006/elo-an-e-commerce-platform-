<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') - Elo Admin</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Arial', sans-serif; display: flex; min-height: 100vh; background: #f0f2f5; }
        .sidebar {
            width: 260px; background: #1a1a2e; color: #fff; padding: 20px; display: flex;
            flex-direction: column; position: fixed; top: 0; left: 0; height: 100vh;
        }
        .sidebar h1 { font-size: 24px; margin-bottom: 30px; padding-bottom: 20px; border-bottom: 1px solid rgba(255,255,255,0.1); }
        .sidebar h1 a { color: #fff; text-decoration: none; }
        .sidebar nav { display: flex; flex-direction: column; gap: 5px; flex: 1; }
        .sidebar nav a {
            padding: 12px 15px; color: rgba(255,255,255,0.7); text-decoration: none;
            border-radius: 8px; transition: all 0.3s; font-size: 14px;
        }
        .sidebar nav a:hover, .sidebar nav a.active { background: rgba(255,255,255,0.1); color: #fff; }
        .sidebar .admin-user { padding-top: 20px; border-top: 1px solid rgba(255,255,255,0.1); font-size: 13px; color: rgba(255,255,255,0.5); }
        .main-content { margin-left: 260px; flex: 1; padding: 30px; }
        .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
        .page-header h2 { font-size: 28px; color: #333; }
        .btn {
            padding: 10px 20px; border-radius: 6px; text-decoration: none; font-size: 14px;
            font-weight: bold; border: none; cursor: pointer; display: inline-block; transition: all 0.3s;
        }
        .btn-primary { background: #1a1a2e; color: #fff; }
        .btn-primary:hover { background: #16213e; }
        .btn-success { background: #28a745; color: #fff; }
        .btn-success:hover { background: #218838; }
        .btn-danger { background: #dc3545; color: #fff; }
        .btn-danger:hover { background: #c82333; }
        .btn-warning { background: #ffc107; color: #333; }
        .btn-warning:hover { background: #e0a800; }
        .btn-sm { padding: 6px 12px; font-size: 12px; }
        .card {
            background: #fff; border-radius: 10px; padding: 25px; box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            margin-bottom: 25px;
        }
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 20px; margin-bottom: 30px; }
        .stat-card {
            background: #fff; border-radius: 10px; padding: 25px; box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        }
        .stat-card .stat-number { font-size: 36px; font-weight: bold; color: #1a1a2e; }
        .stat-card .stat-label { font-size: 14px; color: #888; margin-top: 5px; }
        .stat-card .stat-icon {
            width: 48px; height: 48px; border-radius: 12px; display: flex;
            align-items: center; justify-content: center; font-size: 22px;
            font-weight: bold; margin-bottom: 15px; background: #f0f2ff;
        }
        .alert {
            padding: 15px 20px; border-radius: 6px; margin-bottom: 20px; font-size: 14px;
        }
        .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        table { width: 100%; border-collapse: collapse; }
        table th { text-align: left; padding: 12px 15px; background: #f8f9fa; color: #555; font-size: 13px; text-transform: uppercase; border-bottom: 2px solid #eee; }
        table td { padding: 12px 15px; border-bottom: 1px solid #eee; font-size: 14px; }
        table tr:hover td { background: #f8f9fa; }
        .badge {
            display: inline-block; padding: 4px 10px; border-radius: 20px; font-size: 12px; font-weight: bold;
        }
        .badge-pending { background: #fff3cd; color: #856404; }
        .badge-processing { background: #cce5ff; color: #004085; }
        .badge-shipped { background: #d4edda; color: #155724; }
        .badge-delivered { background: #d4edda; color: #155724; }
        .badge-cancelled { background: #f8d7da; color: #721c24; }
        .badge-low-stock { background: #f8d7da; color: #721c24; }
        .badge-in-stock { background: #d4edda; color: #155724; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 6px; font-weight: bold; font-size: 14px; color: #555; }
        .form-control {
            width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px;
            transition: border 0.3s;
        }
        .form-control:focus { outline: none; border-color: #1a1a2e; }
        textarea.form-control { resize: vertical; min-height: 120px; }
        select.form-control { background: #fff; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .actions { display: flex; gap: 8px; }
        .pagination { margin-top: 20px; }
        .pagination-inner { display: flex; align-items: center; justify-content: center; gap: 5px; }
        .page-link {
            padding: 4px 10px; background: #fff; border: 1px solid #ddd; border-radius: 4px;
            text-decoration: none; color: #333; font-size: 13px; min-width: 28px; text-align: center; display: inline-block;
        }
        .page-link:hover { background: #f0f0f0; }
        .page-link.active { background: #1a1a2e; color: #fff; border-color: #1a1a2e; cursor: default; }
        .page-link.disabled { color: #ccc; cursor: default; }
        .page-link.disabled:hover { background: #fff; }
        .page-link.page-arrow { padding: 4px 4px; min-width: 20px; }
        .page-arrow-icon { width: 8px; height: 8px; display: block; }
        .table-img { width: 50px; height: 50px; border-radius: 6px; object-fit: cover; background: #f0f0f0; }
        @media (max-width: 768px) {
            .sidebar { width: 100%; height: auto; position: relative; }
            .main-content { margin-left: 0; }
            .form-row { grid-template-columns: 1fr; }
            .stats-grid { grid-template-columns: 1fr 1fr; }
        }
    </style>
</head>
<body>
    <aside class="sidebar">
        <h1><a href="{{ route('admin.dashboard') }}">ELO Admin</a></h1>
        <nav>
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Dashboard</a>
            <a href="{{ route('admin.products') }}" class="{{ request()->routeIs('admin.products*') ? 'active' : '' }}">Products</a>
            <a href="{{ route('admin.categories') }}" class="{{ request()->routeIs('admin.categories*') ? 'active' : '' }}">Categories</a>
            <a href="{{ route('admin.orders') }}" class="{{ request()->routeIs('admin.orders*') ? 'active' : '' }}">Orders</a>
            <a href="{{ route('admin.users') }}" class="{{ request()->routeIs('admin.users*') ? 'active' : '' }}">Users</a>
        </nav>
        <div class="admin-user">
            <div>{{ Auth::user()->name }}</div>
            <a href="{{ route('home') }}" style="color: rgba(255,255,255,0.5); text-decoration: none; font-size: 12px;">← Back to Site</a>
        </div>
    </aside>
    <main class="main-content">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif
        @yield('content')
    </main>
</body>
</html>
