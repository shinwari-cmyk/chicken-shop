<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Chicken Shop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    body { background-color: #fff8f0; font-family: 'Poppins', sans-serif; }
    nav { background: linear-gradient(90deg, #dc3545, #ff6b6b); }
    nav a { color: white !important; font-weight: 500; }
    footer { background-color: #222; color: white; text-align: center; padding: 15px; margin-top: 30px; }
  </style>
</head>
<body>

  <!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark shadow fixed-top">
    <div class="container">
      <a class="navbar-brand fw-bold text-white" href="{{ url('/') }}">🍗 Chicken Shop</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a href="{{ route('home') }}" class="nav-link">Home</a></li>
          <li class="nav-item"><a href="{{ route('menu') }}" class="nav-link">Menu</a></li>
          <li class="nav-item"><a href="{{ route('products.index') }}" class="nav-link">Products</a></li>
<li class="nav-item position-relative">
    <a href="{{ url('cart') }}" class="nav-link">
        🛒 Cart
        <span id="cart-count"
              class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            {{ session('cart') ? count(session('cart')) : 0 }}
        </span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ route('orders.index') }}">
        📦 Orders
    </a>
</li>



          <li class="nav-item"><a href="{{ route('contact') }}" class="nav-link">Contact</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container my-5">
    @yield('content')
  </div>

  @php
    $whatsappNumber = '923170097125'; // Your WhatsApp number
  @endphp

  <!-- Floating WhatsApp Button -->
  @if(session()->has('cart') && count(session('cart')) > 0)
  <a href="#" id="whatsappCartBtn" 
     style="
          position: fixed;
          bottom: 20px;
          right: 20px;
          z-index: 1000;
          background-color: #25D366;
          color: white;
          border-radius: 50%;
          width: 60px;
          height: 60px;
          display: flex;
          align-items: center;
          justify-content: center;
          font-size: 30px;
          box-shadow: 0 2px 10px rgba(0,0,0,0.3);
          text-decoration: none;
     ">
      <i class="fab fa-whatsapp"></i>
  </a>
  @endif

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
  AOS.init({
    duration: 900,
    once: true,
    easing: 'ease-out-cubic'
  });

  axios.defaults.headers.common['X-CSRF-TOKEN'] =
      document.querySelector('meta[name="csrf-token"]').content;

  // ✅ WhatsApp button for cart
  document.getElementById('whatsappCartBtn')?.addEventListener('click', function(e){
      e.preventDefault();

      const cart = @json(session('cart', []));
      if(cart.length === 0){
          alert("Your cart is empty!");
          return;
      }

      // Ask for customer info
      const customerName = prompt("Enter your name:");
      const phone = prompt("Enter your phone number:");

      if(!customerName || !phone){
          alert("Name and phone are required!");
          return;
      }

      // 1️⃣ Save all items in DB as WhatsApp orders
      cart.forEach(item => {
          axios.post("{{ route('cart.submit') }}", {
              customer_name: customerName,
              phone: phone,
              item_name: item.name,
              rate_per_kg: item.price,
              weight: item.kg,
              source: 'whatsapp'
          });
      });

      // 2️⃣ Prepare WhatsApp message
      let message = `New Order Received:\nName: ${customerName}\nPhone: ${phone}\n`;
      let grandTotal = 0;

      cart.forEach(item => {
          const kg = parseFloat(item.kg || 1);
          const price = parseFloat(item.price || 0);
          const lineTotal = kg * price;
          grandTotal += lineTotal;
          message += `${item.name} - ${kg} kg - Rs ${lineTotal}\n`;
      });

      message += `Grand Total: Rs ${grandTotal}`;

      // 3️⃣ Open WhatsApp
      const whatsappUrl = `https://wa.me/{{ $whatsappNumber }}?text=${encodeURIComponent(message)}`;
      window.open(whatsappUrl, '_blank');

      alert("✅ Order placed successfully! WhatsApp message ready.");
  });
</script>

</body>
</html>
