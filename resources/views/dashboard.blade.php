@extends('layouts.app')

@section('content')
<div class="container mt-5">
  <div class="row">
    <div class="col-md-3">
      <div class="card p-3 shadow">
        <h4>Admin Dashboard</h4>
        <ul class="list-group list-group-flush">
          <a href="{{ route('products.index') }}" class="list-group-item">Products</a>
          <a href="{{ route('categories.index') }}" class="list-group-item">Categories</a>
          <a href="{{ route('orders.index') }}" class="list-group-item">Orders</a>
          <a href="{{ route('orders.history') }}" class="list-group-item">Order History</a>
        </ul>
      </div>
    </div>

    <div class="col-md-9">
      <div class="card p-4 shadow">
        <h3>Welcome to Admin Dashboard</h3>
        <p>Here you will see stats and quick links.</p>
      </div>
    </div>
  </div>
</div>
@endsection
