@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-danger fw-bold mb-4">🛒 Place New Order</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('orders.store') }}" method="POST" class="card shadow-lg p-4">
        @csrf

        <div class="mb-3">
            <label class="form-label fw-bold">Customer Name</label>
            <input type="text" name="customer_name" class="form-control" required placeholder="Enter customer name">
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Email</label>
            <input type="email" name="email" class="form-control" placeholder="Enter customer email">
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Phone Number</label>
            <input type="text" name="phone" class="form-control" placeholder="Enter phone number">
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Location</label>
            <input type="text" name="location" class="form-control" placeholder="Enter delivery address">
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Item Name</label>
            <input type="text" name="item_name" class="form-control" required placeholder="Enter product name">
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Item Price (Rs.)</label>
            <input type="number" name="item_price" class="form-control" required placeholder="Enter item price">
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Quantity</label>
            <input type="number" name="quantity" class="form-control" required placeholder="Enter quantity">
        </div>

        <button type="submit" class="btn btn-danger w-100 mt-3">Place Order</button>
    </form>
</div>
@endsection
