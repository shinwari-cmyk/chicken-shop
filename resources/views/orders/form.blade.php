@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <h2 class="mb-4 text-center">🛒 Place Order: {{ $product->name }}</h2>

    <form action="{{ route('orders.store') }}" method="POST">
        @csrf

        <input type="hidden" name="item_name" value="{{ $product->name }}">
        <input type="hidden" name="rate_per_kg" id="rate_per_kg" value="{{ $rate }}">

        {{-- Customer Info --}}
        <div class="card mb-4">
            <div class="card-header fw-bold">Customer Details</div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Customer Name *</label>
                    <input type="text" name="customer_name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Phone *</label>
                    <input type="text" name="phone" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email (optional)</label>
                    <input type="email" name="email" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Location / Address (optional)</label>
                    <input type="text" name="location" class="form-control">
                </div>
            </div>
        </div>

        {{-- Order Item --}}
        <div class="card mb-4">
            <div class="card-header fw-bold">Order Item</div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Item</label>
                    <input type="text" class="form-control" value="{{ $product->name }}" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Rate per KG (Rs)</label>
                    <input type="number" class="form-control" id="rate_per_kg_display" value="{{ $rate }}" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Weight (KG) *</label>
                    <input type="number" name="weight" id="weight" step="0.01" min="0.01" class="form-control" required oninput="calculatePrice()">
                </div>

                <div class="mb-3">
                    <label class="form-label">Total Price (Rs)</label>
                    <input type="number" name="total_price" id="total_price" class="form-control" readonly>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-success btn-lg">🛒 Place Order</button>
                </div>
            </div>
        </div>

    </form>
</div>

<script>
function calculatePrice() {
    const rate = parseFloat(document.getElementById('rate_per_kg').value) || 0;
    const weight = parseFloat(document.getElementById('weight').value) || 0;
    document.getElementById('total_price').value = (rate * weight).toFixed(2);
}
</script>
@endsection
