@extends('layouts.app')

@section('content')

@php
use Illuminate\Support\Facades\File;

$images = File::exists(public_path('images'))
    ? collect(File::files(public_path('images')))->filter(function ($file) {
        return in_array(strtolower($file->getExtension()), ['jpg','jpeg','png','webp']);
    })
    : collect([]);
@endphp

<!-- FULL WIDTH HERO SLIDER -->
<div class="hero-container">

    @if($images->count() > 0)
    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
        <!-- carousel auto slides every 3 seconds -->

        <div class="carousel-inner">
            @foreach($images as $index => $img)
            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                <div class="hero-slide">
                    <img src="{{ asset('images/' . $img->getFilename()) }}" class="hero-img">

                    <!-- Overlay Content -->
                    <div class="hero-overlay">
                        <h1>Fresh Chicken Everyday</h1>
                        <p>Clean • Hygienic • Premium Quality</p>
                        <a href="{{ route('menu') }}" class="btn btn-accent mt-3">
                            View Menu
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>

        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>

    </div>
    @endif

</div>

<!-- CATEGORIES -->
<div class="container py-5">
    <h2 class="text-center text-danger fw-bold mb-4">Shop by Category 🍗</h2>

    <input type="text" id="categorySearch" class="form-control mb-4" placeholder="Search categories...">

    <div class="row g-4">
        @foreach($categories as $category)
        <div class="col-lg-3 col-md-4 col-sm-6 category-card">
            <div class="card category-box text-center p-4">
                <h5 class="fw-bold">{{ $category->name }}</h5>
                <a href="{{ route('menu', ['category' => $category->id]) }}" class="btn btn-outline-danger btn-sm mt-2">
                    View
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>
<!-- CONTACT SECTION -->
<div class="container py-5" id="contact">
    <h2 class="text-center text-danger fw-bold mb-4">Contact Us 📞</h2>

    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <div class="card shadow-sm p-4 contact-card">
                <h5 class="fw-bold text-center mb-3">Get in Touch</h5>
                <p class="text-center">Have questions or want to place a special order? Contact us directly!</p>

                <ul class="list-unstyled mb-3">
                    <li><strong>Phone:</strong> +92 3170097125</li>
                    <li><strong>Email:</strong> info@chickenshop.com</li>
                    <li><strong>Address:</strong> Noorchohk, AbbottabadCity, Pakistan</li>
                </ul>

                <!-- BUTTON TO CONTACT PAGE -->
                <div class="text-center">
                    <a href="{{ route('contact') }}" class="btn btn-accent btn-lg">
                        Send Message / Go to Contact
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.contact-card {
    border-radius: 15px;
    transition: 0.3s;
    text-align: center;
}
.contact-card:hover {
    transform: scale(1.02);
}
.contact-card ul li {
    margin: 8px 0;
}
.btn-accent {
    background: #E63946;
    color: #fff;
    border-radius: 30px;
    padding: 10px 25px;
    font-weight: 600;
}
.btn-accent:hover {
    background: #D62828;
}
</style>   

<!-- FEATURED -->
@if(isset($featuredProducts) && $featuredProducts->count())
<div class="container pb-5">
    <h2 class="text-center text-danger fw-bold mb-4">Featured Products 🍗</h2>

    <div class="row g-4">
        @foreach($featuredProducts as $product)
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="card product-box text-center">

                @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" class="product-img">
                @endif

                <div class="card-body">
                    <h6 class="fw-bold text-danger">{{ $product->name }}</h6>
                    <p>Rs {{ $product->price }} / KG</p>
                </div>

            </div>
        </div>
        @endforeach
    </div>
</div>
@endif

<!-- SEARCH JS -->
<script>
document.getElementById('categorySearch').addEventListener('input', function(){
    let val = this.value.toLowerCase();
    document.querySelectorAll('.category-card').forEach(card=>{
        card.style.display = card.innerText.toLowerCase().includes(val) ? '' : 'none';
    });
});
</script>

<!-- STYLES -->
<style>

/* 60-30-10 COLORS */
body {
    background: #F8F9FA; /* 60% light */
}

/* HERO */
.hero-container {
    width: 100%;
    margin-top: -40px;
}

.hero-slide {
    position: relative;
}

.hero-img {
    width: 100%;
    height: 420px;
    object-fit: cover;
}

/* DARK OVERLAY */
.hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.5); /* 30% dark */
    color: #fff;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

/* ACCENT */
.btn-accent {
    background: #E63946; /* 10% red */
    color: #fff;
    border-radius: 30px;
    padding: 8px 20px;
}

/* CATEGORY */
.category-box {
    border-radius: 15px;
    transition: 0.3s;
}

.category-box:hover {
    transform: translateY(-5px);
}

/* PRODUCTS */
.product-img {
    height: 200px;
    object-fit: cover;
}

.product-box:hover {
    transform: scale(1.05);
    transition: 0.3s;
}

/* REMOVE DEFAULT FOOTER */
footer {
    display: none;
}

</style>

@endsection