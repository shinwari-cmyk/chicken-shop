@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-3">Add Rate for: {{ $product->name }}</h2>

    <a href="{{ route('product_rates.index', $product->id) }}" class="btn btn-secondary mb-3">
        Back to Rates
    </a>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('product_rates.store', $product->id) }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Weight (KG)</label>
                    <input type="number" step="0.01" name="weight" id="weight"
                           class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Rate per KG</label>
                    <input type="number" step="0.01" name="rate_per_kg" id="rate_per_kg"
                           class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Calculated Price</label>
                    <input type="number" step="0.01" id="price"
                           class="form-control" readonly>
                </div>

                <div class="form-check mb-3">
                    <input type="checkbox" name="active" value="1" class="form-check-input">
                    <label class="form-check-label">Active Rate</label>
                </div>

                <div class="mb-3">
                    <label class="form-label">Note</label>
                    <textarea name="note" rows="2" class="form-control"></textarea>
                </div>

                <button class="btn btn-success">Save Rate</button>
            </form>
        </div>
    </div>
</div>

<script>
function calculatePrice() {
    let weight = parseFloat(document.getElementById('weight').value) || 0;
    let rate   = parseFloat(document.getElementById('rate_per_kg').value) || 0;
    document.getElementById('price').value = (weight * rate).toFixed(2);
}

document.getElementById('weight').addEventListener('input', calculatePrice);
document.getElementById('rate_per_kg').addEventListener('input', calculatePrice);
</script>
@endsection
