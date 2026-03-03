@extends('layouts.app')

@section('content')
<div class="container text-center">

    <h1 class="mb-4">Admin Dashboard</h1>

    <div class="mb-4">
        <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg m-2">
            Manage Products
        </a>

        <a href="{{ route('orders.index') }}" class="btn btn-success btn-lg m-2">
            Manage Orders
        </a>
    </div>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn btn-danger">
            Logout
        </button>
    </form>

</div>
@endsection