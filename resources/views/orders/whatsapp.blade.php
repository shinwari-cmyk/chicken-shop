@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h3 class="text-success mb-4">📲 Order via WhatsApp</h3>

    <form method="POST" action="{{ route('whatsapp.store') }}">
        @csrf

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="customer_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Phone</label>
            <input type="text" name="phone" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Address</label>
            <textarea name="address" class="form-control" required></textarea>
        </div>

        <hr>
        <h5>🛒 Products</h5>
        <ul class="list-group mb-3">
            @php $grandTotal = 0; @endphp
            @foreach($cart as $item)
                @php
                    $weight = $item['weight'] ?? 1;
                    $lineTotal = $item['price'] * $weight;
                    $grandTotal += $lineTotal;
                @endphp
                <li class="list-group-item d-flex justify-content-between">
                    {{ $item['name'] }} ({{ $weight }} KG)
                    <strong>Rs {{ $lineTotal }}</strong>
                </li>
            @endforeach
        </ul>

        <h4 class="text-danger">Grand Total: Rs {{ $grandTotal }}</h4>

        <button class="btn btn-success btn-lg w-100 mt-3">
            📲 Place Order from WhatsApp
        </button>
    </form>
</div>
@endsection
