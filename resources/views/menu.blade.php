@extends('layouts.app')

@section('content')

<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

<style>
body{
    font-family: 'Poppins', sans-serif;
    background: #0f0c29;
    background: linear-gradient(135deg, #0f0c29, #302b63, #24243e);
    overflow-x: hidden;
}

/* Floating background animation */
body::before{
    content:'';
    position:fixed;
    width:200%;
    height:200%;
    background: radial-gradient(circle at 20% 30%, rgba(255,0,150,0.15), transparent 40%),
                radial-gradient(circle at 80% 70%, rgba(0,200,255,0.15), transparent 40%);
    animation: floatBG 15s infinite alternate;
    z-index:-1;
}

@keyframes floatBG{
    from{ transform:translate(0,0); }
    to{ transform:translate(-100px,-50px); }
}

/* Title */
.menu-title{
    font-size:2.7rem;
    font-weight:800;
    background: linear-gradient(45deg,#ff9966,#ff5e62);
    -webkit-background-clip:text;
    -webkit-text-fill-color:transparent;
}

/* Glass Card */
.glass-card{
    background: rgba(255,255,255,0.07);
    backdrop-filter: blur(15px);
    border-radius:20px;
    border:1px solid rgba(255,255,255,0.2);
    transition:all .4s ease;
    overflow:hidden;
    opacity:0;
    transform:translateY(40px);
    animation: fadeUp .8s forwards;
}

.glass-card:hover{
    transform:translateY(-10px) scale(1.03);
    box-shadow:0 20px 50px rgba(0,0,0,0.5);
}

@keyframes fadeUp{
    to{
        opacity:1;
        transform:translateY(0);
    }
}

.card-img-top{
    height:230px;
    object-fit:cover;
    transition:transform .5s ease;
}

.glass-card:hover .card-img-top{
    transform:scale(1.1);
}

.product-title{
    color:#fff;
    font-weight:600;
}

.product-price{
    color:#ffc107;
    font-weight:600;
}

.kg-input{
    border-radius:30px;
    text-align:center;
    font-weight:600;
}

.btn-modern{
    border-radius:50px;
    font-weight:600;
    transition:all .3s ease;
}

.btn-modern:hover{
    transform:scale(1.05);
}

.btn-website{
    background:linear-gradient(45deg,#2193b0,#6dd5ed);
    border:none;
}

.btn-whatsapp{
    background:linear-gradient(45deg,#25D366,#128C7E);
    border:none;
}

/* Toast popup */
.toast-custom{
    position:fixed;
    top:20px;
    right:20px;
    background:#28a745;
    color:#fff;
    padding:15px 25px;
    border-radius:30px;
    box-shadow:0 10px 30px rgba(0,0,0,.3);
    display:none;
    z-index:9999;
}
</style>

<div class="container py-5">
    <h2 class="text-center menu-title mb-5">🍗 Luxury Chicken Menu</h2>

    <div class="row g-4">
        @foreach($products as $index => $product)
            <div class="col-md-4">
                <div class="glass-card h-100 text-center p-3"
                     style="animation-delay: {{ $index * 0.15 }}s;">

                    <img src="{{ asset('storage/' . $product->image) }}"
                         class="card-img-top rounded-top"
                         alt="{{ $product->name }}">

                    <div class="mt-3">
                        <h5 class="product-title">{{ $product->name }}</h5>
                        <p class="product-price">Rs {{ $product->price }} / KG</p>

                        <input type="number"
                               class="form-control mb-3 kg-input"
                               data-id="{{ $product->id }}"
                               value="0.5"
                               step="0.1"
                               min="0.1">

                        <button class="btn btn-modern btn-website text-white w-100 mb-2 add-cart"
                                data-id="{{ $product->id }}">
                            🛒 Order via Website
                        </button>

                        <button class="btn btn-modern btn-whatsapp text-white w-100 whatsapp-btn"
                                data-id="{{ $product->id }}">
                            📲 Order via WhatsApp
                        </button>
                    </div>

                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Toast -->
<div class="toast-custom" id="toastMsg">
    ✅ Added to cart successfully!
</div>

<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
axios.defaults.headers.common['X-CSRF-TOKEN'] =
    document.querySelector('meta[name="csrf-token"]').content;

function showToast(){
    const toast = document.getElementById('toastMsg');
    toast.style.display = 'block';
    setTimeout(() => { toast.style.display='none'; }, 2500);
}

document.querySelectorAll('.add-cart').forEach(btn=>{
    btn.addEventListener('click',function(){
        const id=this.dataset.id;
        const weight=parseFloat(document.querySelector(`.kg-input[data-id="${id}"]`).value)||0.5;

        axios.post("{{ url('cart/add') }}/"+id,{weight})
        .then(res=>{
            showToast();
        })
        .catch(err=>{
            alert('Something went wrong');
        });
    });
});

document.querySelectorAll('.whatsapp-btn').forEach(btn=>{
    btn.addEventListener('click',function(){
        const id=this.dataset.id;
        const weight=parseFloat(document.querySelector(`.kg-input[data-id="${id}"]`).value)||0.5;
        const name=prompt('Enter your name');
        const phone=prompt('Enter your phone');

        if(!name||!phone){
            alert('Name & Phone required');
            return;
        }

        window.location.href="{{ url('cart/direct-whatsapp') }}/"+id+"?weight="+weight+"&name="+name+"&phone="+phone;
    });
});
</script>

@endsection
