@extends('layouts.app')

@section('content')
<!-- === Hero Section === -->
<div class="hero-section text-center text-white py-5" style="
  background: url('{{ url('images/banner.jpg') }}') center/cover no-repeat;
  height: 55vh;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  color: white;
  text-shadow: 0 3px 8px rgba(0,0,0,0.4);
">
  <h1 class="display-5 fw-bold">🐔 Fresh & Premium Chicken Cuts</h1>
  <p class="fs-5">Always clean, tender, and ready to cook — delivered with love ❤️</p>
</div>

<!-- === Image Gallery === -->
<div class="container py-5">
  <h2 class="text-center text-danger fw-bold mb-4 fade-in">Our Fresh Chicken Collection 🍗</h2>

  <div class="row g-4 justify-content-center">
    @php
      $images = [
        'raw_chicken.jpg',
        'breast_qqeema.jpg',
        'breast.jpg',
        'karahi_cut.jpg',
        'drumsticks.jpg',
        'boneless_handi.jpg',
        'boneless_breast.jpg',
        'wings.jpg'
      ];
    @endphp

    @foreach($images as $img)
      <div class="col-md-3 fade-in">
        <a data-fancybox="gallery" href="{{ url('images/'.$img) }}">
          <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
            <img src="{{ url('images/'.$img) }}" class="card-img-top" style="height:230px; object-fit:cover; transition:0.4s;">
          </div>
        </a>
      </div>
    @endforeach
  </div>
</div>
@endsection
