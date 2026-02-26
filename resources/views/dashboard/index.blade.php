@extends('layouts.app')

@section('content')
<div class="container">
  <h2 class="mb-4">Dashboard</h2>

  <div class="row g-3 mb-4">
    <div class="col-md-3">
      <div class="card shadow-sm p-3">
        <h6>Products</h6>
        <h3>{{ $productsCount }}</h3>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card shadow-sm p-3">
        <h6>Categories</h6>
        <h3>{{ $categoriesCount }}</h3>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card shadow-sm p-3">
        <h6>Today's Orders</h6>
        <h3>{{ $ordersToday }}</h3>
      </div>
    </div>
  </div>

  <h5>Recent Orders</h5>
  <div class="card">
    <div class="card-body">
      @if($recentOrders->isEmpty())
        <div class="text-muted">No recent orders</div>
      @else
        <ul class="list-group">
          @foreach($recentOrders as $o)
            <li class="list-group-item">
              #{{ $o->id }} — {{ $o->customer_name }} — Rs. {{ $o->total_price }} — {{ $o->created_at->format('d M h:i A') }}
            </li>
          @endforeach
        </ul>
      @endif
    </div>
  </div>
</div>
@endsection
