 <!-- <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chicken Meat Shop 🍗</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background-color: #fff8f0;
      font-family: 'Poppins', sans-serif;
    }
    nav {
      background: linear-gradient(90deg, #dc3545, #ff6b6b);
    }
    nav a {
      color: white !important;
      font-weight: 500;
    }
    nav a:hover {
      opacity: 0.85;
    }
    footer {
      background-color: #222;
      color: white;
      text-align: center;
      padding: 15px;
      margin-top: 30px;
    }
  </style>
</head>
<body> 

  <nav class="navbar navbar-expand-lg navbar-dark shadow">
    <div class="container">
      <a class="navbar-brand fw-bold text-white" href="{{ route('home') }}">
        🍗 Chicken Meat Shop
      </a>

      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarNav"
      >
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">

          <li class="nav-item">
            <a href="{{ route('home') }}" class="nav-link">Home</a>
          </li>

          <li class="nav-item">
            <a href="{{ route('menu') }}" class="nav-link">Menu</a>
          </li>

          <li class="nav-item">
            <a href="{{ route('orders.index') }}" class="nav-link">Orders</a>
          </li>

          <li class="nav-item">
            <a href="{{ route('contact') }}" class="nav-link">Contact</a>
          </li>

        
          <li class="nav-item">
            <a href="{{ route('products.index') }}" class="nav-link">
              Products
            </a>
          </li>

          {{-- <li class="nav-item">
            <a href="{{ route('categories.index') }}" class="nav-link">Categories</a>
          </li> --}}
          
        </ul>
      </div>
    </div>
  </nav>


  <div class="container my-5">
    @yield('content')
  </div>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html> -->
