<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="d-flex">
    <div class="bg-dark text-white p-3" style="width: 220px; min-height: 100vh;">
        <h4>Admin</h4>
        <ul class="nav flex-column">
            <li class="nav-item"><a class="nav-link text-white" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="{{ route('admin.products.index') }}">Products</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="{{ route('admin.orders.index') }}">Orders</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="{{ route('home') }}">Back to Site</a></li>
        </ul>
    </div>
    <div class="flex-fill p-4">
        @yield('content')
    </div>
</div>
</body>
</html>
