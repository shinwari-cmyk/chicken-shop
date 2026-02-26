@extends('layouts.admin')

@section('content')
<h1>Admin Dashboard</h1>

<p>Total Products: {{ $productsCount }}</p>
<p>Total Orders: {{ $ordersCount }}</p>

<h3>Latest Orders</h3>
<table border="1">
<tr><th>ID</th><th>Customer</th><th>Status</th></tr>
@foreach($latestOrders as $order)
<tr>
<td>{{ $order->id }}</td>
<td>{{ $order->user->name ?? 'Guest' }}</td>
<td>{{ $order->status }}</td>
</tr>
@endforeach<div class="container mt-4">
<div class="row">

<div class="col-md-4">
<div class="card shadow text-center">
<div class="card-body">
<h6>Total Orders</h6>
<h2>{{ $totalOrders }}</h2>
</div></div></div>

<div class="col-md-4">
<div class="card shadow text-center bg-success text-white">
<div class="card-body">
<h6>Total Sales</h6>
<h2>Rs {{ number_format($totalSales,2) }}</h2>
</div></div></div>

<div class="col-md-4">
<div class="card shadow text-center bg-warning">
<div class="card-body">
<h6>Today Orders</h6>
<h2>{{ $todayOrders }}</h2>
</div></div></div>

</div>
</div>

</table>
@endsection
