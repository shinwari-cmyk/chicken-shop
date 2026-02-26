@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="text-danger mb-4">Edit Order #{{ $order->id }}</h2>

    <form action="{{ route('orders.update', $order->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Customer Name</label>
            <input type="text" class="form-control" value="{{ $order->customer_name }}" readonly>
        </div>

        <div class="mb-3">
            <label>Phone</label>
            <input type="text" class="form-control" value="{{ $order->phone }}" readonly>
        </div>

        <div class="mb-3">
            <label>Location</label>
            <input type="text" class="form-control" value="{{ $order->location }}" readonly>
        </div>

        <div class="mb-3">
            <label>Item Name</label>
            <input type="text" class="form-control" value="{{ $order->item_name }}" readonly>
        </div>

        <div class="mb-3">
            <label>Weight (KG)</label>
            <input type="text" class="form-control" value="{{ $order->weight }}" readonly>
        </div>

        <div class="mb-3">
            <label>Rate / KG</label>
            <input type="text" class="form-control" value="{{ $order->rate_per_kg }}" readonly>
        </div>

        <div class="mb-3">
            <label>Total Price</label>
            <input type="text" class="form-control" value="{{ $order->total_price }}" readonly>
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-select">
                <option value="Pending" {{ $order->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Delivered" {{ $order->status == 'Delivered' ? 'selected' : '' }}>Delivered</option>
            </select>
        </div>

        <button class="btn btn-success">Update Order</button>
        <a href="{{ route('orders.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
