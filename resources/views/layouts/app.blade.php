<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>CH Chicken Shop</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #F8F9FA; /* 60% */
        }

        /* NAVBAR - 30% */
        .navbar-custom {
            background-color: #1F2937;
        }

        .navbar-custom .nav-link,
        .navbar-custom .navbar-brand {
            color: #fff !important;
            font-weight: 500;
        }

        .navbar-custom .nav-link:hover {
            color: #E63946 !important;
        }

        /* Accent Buttons - 10% */
        .btn-accent {
            background-color: #E63946;
            color: #fff;
            border: none;
            border-radius: 30px;
            padding: 8px 18px;
            font-weight: 600;
            transition: 0.3s ease;
        }

        .btn-accent:hover {
            background-color: #c92f3c;
            transform: scale(1.05);
        }

        /* Cards */
        .card-modern {
            border: none;
            border-radius: 15px;
            transition: 0.3s ease;
        }

        .card-modern:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        }

        /* Footer */
        footer {
            background-color: #1F2937;
            color: #fff;
            padding: 20px 0;
            margin-top: 50px;
        }
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-custom shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">
            🐔 CH Shop
        </a>

        <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            ☰
        </button>

        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('menu') }}">Menu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cart.checkout') }}">Cart</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contact') }}">Contact</a>
                </li>

                @auth
                    <li class="nav-item">
                        <a class="nav-link text-warning" href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<!-- CONTENT -->
<div class="container py-5">
    @yield('content')
</div>

<!-- FOOTER -->
<footer class="text-center">
    <div class="container">
        © {{ date('Y') }} CH Chicken Shop — Fresh & Premium Quality
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>