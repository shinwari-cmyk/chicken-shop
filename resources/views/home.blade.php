@extends('layouts.app')

@section('content')

<!-- ================= HERO ================= -->
<div class="text-center py-5 mb-5 hero-box">
  <h1 class="fw-bold display-5 mt-5">🐔 Fresh & Premium Chicken Cuts</h1>
  <p class="fs-5 mb-0">
    Always clean, tender, and ready to cook — delivered with love ❤️
  </p>
</div>

<!-- ================= GALLERY ================= -->
<div class="container">
  <h2 class="text-center text-danger fw-bold mb-4">
    Our Fresh Meat Collection 🍗
  </h2>

  @php
    $products = [
      ['file'=>'raw.jpg','name'=>'Whole Raw Chicken','badge'=>'Fresh'],
      ['file'=>'breast.jpeg','name'=>'Chicken Breast','badge'=>'Best Seller'],
      ['file'=>'drumstick.jpeg','name'=>'Drumsticks','badge'=>'Fresh'],
      ['file'=>'karahi.jpeg','name'=>'Karahi Cut','badge'=>'Best Seller'],
      ['file'=>'boneless.jpeg','name'=>'Boneless Breast','badge'=>'Fresh'],
      ['file'=>'handi.jpeg','name'=>'Boneless Handi Cut','badge'=>'Fresh'],
      ['file'=>'wings.jpeg','name'=>'Chicken Wings','badge'=>'Best Seller'],
      ['file'=>'qeema.jpeg','name'=>'Chicken Qeema','badge'=>'Fresh'],
    ];
  @endphp

  <div class="row g-4">
    @foreach($products as $item)
      <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="card product-card border-0 shadow-sm h-100">

          <!-- BADGE -->
          <span class="product-badge {{ $item['badge'] == 'Best Seller' ? 'badge-best' : 'badge-fresh' }}">
            {{ $item['badge'] }}
          </span>

          <!-- IMAGE -->
          <img
            src="{{ asset('storage/products/images/' . $item['file']) }}"
            class="product-image"
            alt="{{ $item['name'] }}"
          >

          <div class="card-body text-center">
            <h6 class="fw-bold text-danger mb-0">
              {{ $item['name'] }}
            </h6>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>
<style>
/* HERO */
.hero-box {
  background: linear-gradient(45deg, #dc3545, #ff9a3c);
  color: #fff;
  border-radius: 20px;
}

/* PRODUCT CARD */
.product-card {
  position: relative;
  border-radius: 16px;
  overflow: hidden;
  transition: transform .25s ease, box-shadow .25s ease;
}

.product-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 15px 30px rgba(0,0,0,.15);
}

/* IMAGE – SAME SIZE */
.product-image {
  width: 100%;
  height: 220px;
  object-fit: cover;
}

/* BADGE BASE */
.product-badge {
  position: absolute;
  top: 12px;
  left: 12px;
  padding: 6px 14px;
  font-size: 12px;
  font-weight: 600;
  color: #fff;
  border-radius: 30px;
  opacity: 0;
  transform: translateY(-5px);
  transition: all .3s ease;
  z-index: 2;
}

/* SHOW ON HOVER */
.product-card:hover .product-badge {
  opacity: 1;
  transform: translateY(0);
}

/* BADGE COLORS */
.badge-fresh {
  background: linear-gradient(45deg, #28a745, #5ddf8d);
}

.badge-best {
  background: linear-gradient(45deg, #ffc107, #ff8f00);
  color: #000;
}

</style>

@endsection
