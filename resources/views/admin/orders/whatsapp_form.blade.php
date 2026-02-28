@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h3 class="text-success mb-4">📲 WhatsApp Order</h3>

    <form method="POST" action="{{ route('whatsapp.store') }}">
        @csrf

        <input class="form-control mb-3" name="customer_name" placeholder="Your Name" required>
        <input class="form-control mb-3" name="phone" placeholder="Phone Number" required>
        <textarea class="form-control mb-3" name="address" placeholder="Delivery Address" required></textarea>

        <ul class="list-group mb-3">
            @php $total = 0; @endphp
            @foreach($cart as $item)
                @php $line = $item['price'] * $item['weight']; $total += $line; @endphp
                <li class="list-group-item d-flex justify-content-between">
                    {{ $item['name'] }} ({{ $item['weight'] }} KG)
                    <strong>Rs {{ $line }}</strong>
                </li>
            @endforeach
        </ul>

        <h4 class="text-danger">Grand Total: Rs {{ $total }}</h4>

        <button class="btn btn-success btn-lg w-100 mt-3">
            📲 Send to WhatsApp
        </button>
    </form>
</div>
@endsection
