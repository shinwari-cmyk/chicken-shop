@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="card shadow-lg glass-card mx-auto" style="max-width: 800px;">
        <div class="card-body">
            <div class="text-center mb-4">
                <h3 class="text-danger fw-bold">🧾 Order Invoice</h3>
                <small class="text-muted">Order #: {{ $order->order_number }}</small>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <p><strong>Customer:</strong> {{ $order->details->customer_name ?? 'N/A' }}</p>
                    <p><strong>Phone:</strong> {{ $order->details->phone ?? 'N/A' }}</p>
                    <p><strong>Email:</strong> {{ $order->email ?? '-' }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Location:</strong> {{ $order->details->address ?? '-' }}</p>
                    <p><strong>Status:</strong> 
                        <span class="badge 
                            @if($order->status == 'pending') bg-warning text-dark
                            @elseif($order->status == 'completed') bg-success
                            @elseif($order->status == 'cancelled') bg-danger
                            @else bg-secondary
                            @endif">
                            {{ ucfirst($order->status) }}
                        </span>
                    </p>
                    <p><strong>Grand Total:</strong> Rs {{ $order->grand_total }}</p>
                </div>
            </div>

            <hr>

            <h5 class="mb-3">Items</h5>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>Item</th>
                            <th>Rate / KG</th>
                            <th>Weight (KG)</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                        <tr>
                            <td>{{ $item->product_name }}</td>
                            <td>Rs {{ $item->unit_price }}</td>
                            <td>{{ $item->weight }}</td>
                            <td>Rs {{ $item->total_price }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="text-center mt-4">
                <button onclick="window.print()" class="btn btn-danger btn-lg">
                    🖨️ Print Invoice
                </button>
            </div>
        </div>
    </div>
</div>

<style>
/* Glassmorphism effect */
.glass-card {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(12px);
    border-radius: 20px;
    border: 1px solid rgba(255,255,255,0.3);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.glass-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.2);
}
table th, table td {
    vertical-align: middle;
}
</style>
@endsection
