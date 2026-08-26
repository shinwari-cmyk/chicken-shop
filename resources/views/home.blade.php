@extends('layouts.app')

@section('content')

@php
use Illuminate\Support\Facades\File;

$images = File::exists(public_path('images'))
    ? collect(File::files(public_path('images')))->filter(function ($file) {
        return in_array(strtolower($file->getExtension()), ['jpg', 'jpeg', 'png', 'webp']);
    })
    : collect([]);

$captions = [
    [
        'title' => 'Fresh Chicken Everyday',
        'subtitle' => 'Clean • Hygienic • Premium Quality',
    ],
    [
        'title' => '100% Farm Fresh Chicken',
        'subtitle' => 'Healthy • Fresh • Delicious',
    ],
    [
        'title' => 'Premium Quality Meat',
        'subtitle' => 'Freshly Cut • Ready to Cook',
    ],
    [
        'title' => 'Taste the Freshness',
        'subtitle' => 'Quality You Can Trust',
    ],
    [
        'title' => 'Best Chicken in Town',
        'subtitle' => 'Fresh Daily • Affordable Prices',
    ],
];
@endphp

<!-- HERO SLIDER -->
<div class="hero-container">

    @if($images->count() > 0)
    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">

        <div class="carousel-inner">

            @foreach($images as $index => $img)

            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                <div class="hero-slide">

                    <img src="{{ asset('images/' . $img->getFilename()) }}" class="hero-img" alt="Hero Image">

                    <div class="hero-overlay">
                        <h1>{{ $captions[$index % count($captions)]['title'] }}</h1>
                        <p>{{ $captions[$index % count($captions)]['subtitle'] }}</p>

                        <a href="{{ route('menu') }}" class="btn btn-accent mt-3">
                            View Menu
                        </a>
                    </div>

                </div>
            </div>

            @endforeach

        </div>

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

                <a href="{{ route('menu',['category'=>$category->id]) }}" class="btn btn-outline-danger btn-sm mt-2">
                    View
                </a>

            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- CONTACT -->
<div class="container py-5">

    <h2 class="text-center text-danger fw-bold mb-4">
        Contact Us 📞
    </h2>

    <div class="row justify-content-center">

        <div class="col-lg-6">

            <div class="card shadow-sm contact-card p-4">

                <h5 class="fw-bold">Get in Touch</h5>

                <p>
                    Have questions or want to place a special order?
                </p>

                <ul class="list-unstyled">
                    <li><strong>Phone:</strong> +92 3170097125</li>
                    <li><strong>Email:</strong> info@chickenshop.com</li>
                    <li><strong>Address:</strong> Noorchohk, Abbottabad City, Pakistan</li>
                </ul>

                <a href="{{ route('contact') }}" class="btn btn-accent mt-3">
                    Send Message / Go to Contact
                </a>

            </div>

        </div>

    </div>

</div>

<!-- FEATURED PRODUCTS -->
@if(isset($featuredProducts) && $featuredProducts->count())

<div class="container pb-5">

    <h2 class="text-center text-danger fw-bold mb-4">
        Featured Products 🍗
    </h2>

    <div class="row g-4">

        @foreach($featuredProducts as $product)

        <div class="col-lg-3 col-md-4 col-sm-6">

            <div class="card product-box">

                @if($product->image)
                    <img src="{{ asset('storage/'.$product->image) }}" class="product-img">
                @endif

                <div class="card-body text-center">
                    <h6 class="fw-bold text-danger">{{ $product->name }}</h6>
                    <p>Rs {{ $product->price }} / KG</p>
                </div>

            </div>

        </div>

        @endforeach

    </div>

</div>

@endif

<script>
document.getElementById('categorySearch').addEventListener('input', function () {

    let value = this.value.toLowerCase();

    document.querySelectorAll('.category-card').forEach(card => {

        card.style.display = card.innerText.toLowerCase().includes(value)
            ? ''
            : 'none';

    });

});
</script>

<style>

body{
    background:#F8F9FA;
}

.hero-container{
    width:100%;
    margin-top:-40px;
}

.hero-slide{
    position:relative;
}

.hero-img{
    width:100%;
    height:420px;
    object-fit:cover;
}

.hero-overlay{
    position:absolute;
    inset:0;
    background:rgba(0,0,0,.5);
    display:flex;
    flex-direction:column;
    justify-content:center;
    align-items:center;
    text-align:center;
    color:#fff;
}

.hero-overlay h1{
    font-size:48px;
    font-weight:700;
}

.hero-overlay p{
    font-size:20px;
}

.btn-accent{
    background:#E63946;
    color:#fff;
    border-radius:30px;
    padding:10px 25px;
}

.btn-accent:hover{
    background:#D62828;
    color:#fff;
}

.category-box{
    border-radius:15px;
    transition:.3s;
}

.category-box:hover{
    transform:translateY(-5px);
}

.product-img{
    height:220px;
    object-fit:cover;
}

.product-box{
    transition:.3s;
}

.product-box:hover{
    transform:scale(1.05);
}

.contact-card{
    border-radius:15px;
    text-align:center;
}

footer{
    display:none;
}

</style>

@endsection