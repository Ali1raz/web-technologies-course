<!DOCTYPE html>
<html>

<head>
    <title>Shopping Site</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('products.index') }}">Shop</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    @if(Session::has('user_name'))
                    <li class="nav-item">
                        <span class="nav-link">Hello, {{ Session::get('user_name') }} ({{ Session::get('user_role') }})</span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <main class="py-4">
        @yield('content')
    </main>
</body>

</html>