<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>CH Chicken Shop</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

<style>
body { font-family: 'Poppins', sans-serif; background-color: #F8F9FA; }

.navbar-custom { background-color: #1F2937; }
.navbar-custom .nav-link, .navbar-custom .navbar-brand { color: #fff !important; font-weight: 500; }
.navbar-custom .nav-link:hover { color: #E63946 !important; }

.btn-accent { background-color: #E63946; color: #fff; border:none; border-radius:30px; padding:8px 18px; font-weight:600; transition:.3s; }
.btn-accent:hover { background-color:#c92f3c; transform:scale(1.05); }

.card-modern { border:none; border-radius:15px; transition:.3s ease; }
.card-modern:hover { transform:translateY(-5px); box-shadow:0 15px 35px rgba(0,0,0,.1); }

.hero-box { background: linear-gradient(45deg,#dc3545,#ff9a3c); color:#fff; border-radius:20px; }
.product-image { width:100%; height:220px; object-fit:cover; }
.product-badge { position:absolute; top:12px; left:12px; padding:6px 14px; font-size:12px; font-weight:600; color:#fff; border-radius:30px; opacity:0; transform:translateY(-5px); transition:all .3s ease; z-index:2; }
.product-card:hover .product-badge { opacity:1; transform:translateY(0); }
.badge-fresh { background: linear-gradient(45deg,#28a745,#5ddf8d); }
.badge-best { background: linear-gradient(45deg,#ffc107,#ff8f00); color:#000; }

footer { background-color:#1F2937; color:#fff; padding:20px 0; margin-top:50px; }
</style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-custom shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">🐔 CH Shop</a>
        <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">☰</button>
        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('menu') }}">Menu</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('cart.checkout') }}">Cart</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contact</a></li>
                @auth
                    <li class="nav-item"><a class="nav-link text-warning" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<!-- CONTENT -->
<div class="container py-5">@yield('content')</div>

<!-- FOOTER -->
<footer class="text-center">
    <div class="container">© {{ date('Y') }} CH Chicken Shop — Fresh & Premium Quality</div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>