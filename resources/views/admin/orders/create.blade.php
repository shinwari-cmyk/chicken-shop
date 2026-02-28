@extends('layouts.app')

@section('content')

<div class="container">
    <h2 class="text-center text-danger mb-4">🛒 Place Your Order</h2>

    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-sm">
                <div class="card-body">

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('orders.store') }}" method="POST">
                        @csrf

                        <!-- Hidden Fields -->
                        <input type="hidden" name="item_name" value="{{ $product->name }}">
                        <input type="hidden" name="rate_per_kg" id="rate" value="{{ $product->activeRate->price ?? 0 }}">
                        <input type="hidden" name="item_price" id="item_price" value="{{ $product->activeRate->price ?? 0 }}">
                        <input type="hidden" name="quantity" value="1">

                        <!-- Customer Details -->
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
                            <label class="form-label">Location (optional)</label>
                            <input type="text" name="location" class="form-control">
                        </div>

                        <!-- Product Info -->
                        <div class="mb-3">
                            <label class="form-label">Item</label>
                            <input type="text" value="{{ $product->name }}" class="form-control" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Rate per KG (Rs)</label>
                            <input type="number" value="{{ $product->activeRate->price ?? 0 }}" class="form-control" readonly>
                        </div>

                        <!-- Weight -->
                        <div class="mb-3">
                            <label class="form-label">Weight (KG) *</label>
                            <input
                                type="number"
                                name="weight"
                                id="weight"
                                step="0.01"
                                min="0.01"
                                class="form-control"
                                required
                                oninput="calculateTotal()"
                            >
                        </div>

                        <!-- Total -->
                        <div class="mb-3">
                            <label class="form-label">Total Price (Rs)</label>
                            <input
                                type="number"
                                name="total_price"
                                id="total_price"
                                class="form-control"
                                readonly
                            >
                        </div>

                        <button class="btn btn-success w-100" type="submit">
                            🛒 Place Order
                        </button>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<script>
function calculateTotal() {
    const rate = parseFloat(document.getElementById('rate').value) || 0;
    const weight = parseFloat(document.getElementById('weight').value) || 0;
    document.getElementById('total_price').value = (rate * weight).toFixed(2);
}
</script>

@endsection
