@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="text-center text-gradient mb-5 fw-bold" style="background: linear-gradient(90deg, #ff416c, #ff4b2b); -webkit-background-clip: text; color: transparent;">
        📦 Orders History
    </h2>

    <div class="row g-4">
        @forelse($orders as $order)
        <div class="col-md-6 col-lg-4">
            <div class="card glass-card shadow-lg h-100 border-0">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h5 class="card-title mb-0">{{ $order->order_number }}</h5>
                        <span class="badge 
                            @if($order->status=='pending') bg-warning text-dark
                            @elseif($order->status=='completed') bg-success
                            @elseif($order->status=='cancelled') bg-danger
                            @else bg-secondary
                            @endif">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>

                    <p class="mb-1"><strong>Customer:</strong> {{ $order->details->customer_name ?? 'N/A' }}</p>
                    <p class="mb-1"><strong>Phone:</strong> {{ $order->details->phone ?? 'N/A' }}</p>
                    <p class="mb-3"><strong>Address:</strong> {{ $order->details->address ?? 'N/A' }}</p>

                    <div class="flex-grow-1 mb-3">
                        <h6>Items:</h6>
                        @foreach($order->items as $item)
                        <div class="d-flex justify-content-between align-items-center py-1 px-2 mb-1 rounded bg-light bg-opacity-50">
                            <span>{{ $item->product_name }} ({{ $item->weight }} KG)</span>
                            <span>Rs {{ $item->total_price }}</span>
                        </div>
                        @endforeach
                    </div>

                    <h5 class="text-end mb-3">Grand: <strong>Rs {{ $order->grand_total }}</strong></h5>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('orders.invoice', $order->id) }}" class="btn btn-sm btn-info w-48">
                            🧾 Invoice
                        </a>

                        <form action="{{ route('orders.destroy', $order->id) }}" method="POST" class="w-48">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger w-100"
                                    onclick="return confirm('Are you sure to delete this order?')">
                                🗑 Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-secondary text-center">
                No orders found.
            </div>
        </div>
        @endforelse
    </div>
</div>

<style>
/* Glassmorphism Card Style */
.glass-card {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(15px);
    border-radius: 15px;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.glass-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 25px rgba(0,0,0,0.2);
}

/* Gradient Text */
.text-gradient {
    font-size: 2.5rem;
}
</style>
@endsection
