@extends('layouts.app')

@section('content')

<div class="container py-5">

<h3 class="text-danger mb-4">📦 Orders History</h3>

<table class="table table-bordered text-center">

<thead class="table-dark">
<tr>
<th>ID</th>
<th>Order No</th>
<th>Customer</th>
<th>Phone</th>
<th>Total</th>
<th>Source</th>
<th>Status</th>
<th>Invoice</th>
</tr>
</thead>

<tbody>

@foreach($orders as $order)

<tr>

<td>{{ $order->id }}</td>

<td>{{ $order->order_number }}</td>

<td>{{ $order->details->customer_name ?? '-' }}</td>

<td>{{ $order->details->phone ?? '-' }}</td>

<td>Rs {{ $order->grand_total }}</td>

<td>
@if($order->order_source == 'website')
<span class="badge bg-primary">Website</span>
@else
<span class="badge bg-success">WhatsApp</span>
@endif
</td>

<td>{{ ucfirst($order->status) }}</td>

<td>
<a href="{{ route('orders.invoice',$order->id) }}" class="btn btn-sm btn-danger">
Print
</a>
</td>

</tr>

@endforeach

</tbody>

</table>

</div>

@endsection