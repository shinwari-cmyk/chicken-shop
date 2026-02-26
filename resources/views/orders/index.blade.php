@extends('layouts.app')
@section('content')
<div class="container py-5">
    <h3 class="text-danger mb-4">📦 Orders History</h3>

    <table class="table table-bordered table-hover text-center">
        <thead class="table-warning">
            <tr>
                <th>#</th>
                <th>Customer</th>
                <th>Phone</th>
                <th>Item</th>
                <th>Weight</th>
                <th>Total</th>
                <th>Source</th>
            </tr>
        </thead>
        <tbody>
            @foreach($websiteOrders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->customer_name }}</td>
                <td>{{ $order->phone }}</td>
                <td>{{ $order->item_name }}</td>
                <td>{{ $order->quantity }} KG</td>
                <td>Rs {{ $order->total_price }}</td>
                <td><span class="badge bg-primary">WEBSITE</span></td>
            </tr>
            @endforeach

            @foreach($whatsappOrders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->customer_name }}</td>
                <td>{{ $order->phone }}</td>
                <td>{{ $order->item_name }}</td>
                <td>{{ $order->weight }} KG</td>
                <td>Rs {{ $order->total_price }}</td>
                <td><span class="badge bg-success">WHATSAPP</span></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
