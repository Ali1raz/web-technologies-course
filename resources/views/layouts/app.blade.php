<!DOCTYPE html>
<html>

<head>
    <title>@yield('title', 'Student Portal')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <style>
        body {
            background: linear-gradient(to right, #74ebd5, #acb6e5);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            font-size: 16px;
        }

        .navbar {
            background-color: rgba(255, 255, 255, 0.95);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 1rem;
        }

        .navbar-brand {
            font-weight: bold;
            color: #2d3436;
            font-size: 1.5rem;
        }

        .nav-link {
            color: #2d3436;
            font-weight: 500;
            padding: 0.5rem 1rem;
            transition: color 0.3s ease;
        }

        .nav-link:hover {
            color: #0984e3;
        }

        .content {
            flex: 1;
            padding: 1.5rem 0;
        }

        .footer {
            background-color: rgba(255, 255, 255, 0.95);
            padding: 1rem 0;
            margin-top: auto;
            box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.1);
        }

        .footer p {
            margin: 0;
            color: #2d3436;
            font-size: 0.9rem;
        }

        .btn-link {
            text-decoration: none;
            padding: 0.5rem 1rem;
        }

        .btn-link:hover {
            text-decoration: underline;
        }

        .alert {
            margin-bottom: 1.5rem;
        }

        .card {
            margin-bottom: 1.5rem;
        }

        .form-control {
            font-size: 1rem;
        }

        .form-label {
            margin-bottom: 0.5rem;
        }

        .btn {
            padding: 0.5rem 1.5rem;
            font-size: 1rem;
        }

        .profile-pic {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid #198754;
            margin-bottom: 1rem;
        }

        @media (max-width: 768px) {
            .navbar-brand {
                font-size: 1.2rem;
            }

            .nav-link {
                padding: 0.5rem;
            }

            .content {
                padding: 1rem 0;
            }

            .card {
                margin: 0 0.5rem 1rem;
            }

            .btn {
                width: 100%;
                margin-bottom: 0.5rem;
            }

            .btn+.btn {
                margin-left: 0 !important;
            }

            .profile-pic {
                width: 100px;
                height: 100px;
            }

            .footer p {
                text-align: center !important;
                margin-bottom: 0.5rem;
            }
        }

        @media (max-width: 576px) {
            .container {
                padding-left: 1rem;
                padding-right: 1rem;
            }

            .navbar {
                padding: 0.5rem;
            }

            .navbar-brand {
                font-size: 1.1rem;
            }

            .card {
                padding: 1rem !important;
            }

            h2 {
                font-size: 1.5rem;
            }
        }
    </style>
    @yield('styles')
</head>

<body>
    {{-- Header --}}
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ route('dashboard') }}">Student Portal</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @if(Session::has('student'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('profile.edit') }}">Edit Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('courses.index') }}">Courses</a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-link nav-link">Logout</button>
                        </form>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <main class="content">
        <div class="container">
            @if(session('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @yield('content')
        </div>
    </main>

    {{-- Footer --}}
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p>&copy; {{ date('Y') }} Student Portal. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-end">
                    <p>Developed with ❤️ for Students</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>

</html>