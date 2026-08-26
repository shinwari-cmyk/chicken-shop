@extends('layouts.app')

@section('content')

<div class="text-center mb-5">
    <h2 class="fw-bold text-dark">🍗 Our Premium Chicken Menu</h2>
    <p class="text-muted">Fresh, hygienic & ready to cook</p>
</div>

<!-- CATEGORY FILTER -->
<div class="mb-4 text-center">
    <a href="{{ route('menu') }}" class="btn btn-outline-dark btn-sm me-2">All</a>

    @foreach($categories as $category)
        <a href="{{ route('menu', ['category' => $category->id]) }}"
           class="btn btn-outline-dark btn-sm me-2">
           {{ $category->name }}
        </a>   
    @endforeach
</div>

<!-- PRODUCTS -->
<div class="row g-4">

    @foreach($products as $product)

        <div class="col-lg-4 col-md-6">
            <div class="card card-modern shadow-sm h-100">

                {{-- IMAGE FIX (WORKS FOR ALL TYPES) --}}
               <img src="http://dev.shopadmin/storage/{{ $product->image }}"
     class="card-img-top"
     style="height:220px; object-fit:cover;"
     alt="{{ $product->name }}">
                <div class="card-body text-center">

                    <h5 class="fw-bold text-dark">
                        {{ $product->name }}
                    </h5>

                    <p class="fw-semibold mb-3 text-danger">
Rs {{ $product->activeRate->price ?? $product->final_price }} / KG                 </p>

                    <input type="number"
                           class="form-control mb-3 text-center"
                           data-id="{{ $product->id }}"
                           value="0.5"
                           step="0.1"
                           min="0.1">

                    <button class="btn btn-accent w-100 mb-2 add-cart"
                            data-id="{{ $product->id }}">
                        🛒 Order via Website
                    </button>

                    <button class="btn btn-outline-dark w-100 whatsapp-btn"
                            data-id="{{ $product->id }}">
                        📲 Order via WhatsApp
                    </button>

                </div>
            </div>
        </div>

    @endforeach

</div>

<!-- TOAST -->
<div id="toastMsg"
     class="position-fixed top-0 end-0 m-4 p-3 rounded shadow"
     style="background:#E63946; color:white; display:none; z-index:9999;">
    ✅ Added to cart successfully!
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>

axios.defaults.headers.common['X-CSRF-TOKEN'] =
document.querySelector('meta[name="csrf-token"]').content;


// SHOW TOAST
function showToast() {
    const toast = document.getElementById('toastMsg');
    toast.style.display = 'block';

    setTimeout(() => {
        toast.style.display = 'none';
    }, 2000);
}


// ADD TO CART
document.querySelectorAll('.add-cart').forEach(btn => {
    btn.addEventListener('click', function () {

        const id = this.dataset.id;

        const weight = parseFloat(
            document.querySelector(`input[data-id="${id}"]`).value
        ) || 0.5;

        axios.post("{{ url('cart/add') }}/" + id, {
            weight: weight
        })
        .then(res => {
            showToast();

            const cartCount = document.getElementById('cart-count');
            if (cartCount) {
                cartCount.innerText = res.data.cart_count;
            }
        })
        .catch(error => {
            console.log(error);
            alert('Something went wrong');
        });

    });
});


// WHATSAPP
document.querySelectorAll('.whatsapp-btn').forEach(btn => {
    btn.addEventListener('click', function () {

        const id = this.dataset.id;

        const weight = parseFloat(
            document.querySelector(`input[data-id="${id}"]`).value
        ) || 0.5;

        const name = prompt('Enter your name');
        const phone = prompt('Enter your phone');

        if (!name || !phone) {
            alert('Name & Phone required');
            return;
        }

        window.location.href =
            "{{ url('cart/direct-whatsapp') }}/" + id +
            "?weight=" + weight +
            "&name=" + name +
            "&phone=" + phone;

    });
});

</script>

@endsection