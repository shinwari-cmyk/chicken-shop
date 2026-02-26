@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="text-center text-danger fw-bold mb-4">
        📦 Customer Orders
    </h1>
    <p class="text-center text-muted mb-5">
        Review all incoming chicken meat orders below 🐔
    </p>

    <!-- Orders Table -->
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-4">
            @if($orders->isEmpty())
                <div class="text-center py-5">
                    <img src="{{ asset('images/no-orders.png') }}" alt="No Orders" style="width: 180px;">
                    <h4 class="text-muted mt-3">No orders received yet.</h4>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle text-center">
                        <thead class="table-danger text-white">
                            <tr>
                                <th>#</th>
                                <th>Customer Name</th>
                                <th>Item</th>
                                <th>Price (Rs)</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $index => $order)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $order->customer_name }}</td>
                                    <td>{{ $order->item_name }}</td>
                                    <td>{{ $order->price }}</td>
                                    <td>{{ $order->phone }}</td>
                                    <td>{{ $order->address }}</td>
                                    <td>{{ $order->created_at->format('d M, Y h:i A') }}</td>
                                    <td>
                                        <form action="{{ route('orders.destroy', $order->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this order?')">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
