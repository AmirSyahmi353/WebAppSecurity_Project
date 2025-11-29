<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f7f9fc;
        }

        .admin-sidebar {
            width: 240px;
            min-height: 100vh;
            background: #1e3a5f;
            padding: 20px;
            position: fixed;
        }

        .admin-sidebar a {
            display: block;
            padding: 12px;
            color: #fff;
            text-decoration: none;
            border-radius: 6px;
            margin-bottom: 6px;
            font-weight: 500;
        }

        .admin-sidebar a:hover,
        .admin-sidebar a.active {
            background: #2f507a;
        }

        .admin-content {
            margin-left: 260px;
            padding: 30px;
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <div class="admin-sidebar">
        <h4 class="text-white mb-4">Admin Panel</h4>

        <a href="{{ route('admin.dietitians.index') }}" 
           class="{{ request()->routeIs('admin.dietitians.*') ? 'active' : '' }}">
            Dietitian Management
        </a>

        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" hidden>
            @csrf
        </form>
    </div>

    <!-- CONTENT -->
    <div class="admin-content">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
