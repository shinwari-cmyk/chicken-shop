@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Products List</h2>
    <a href="{{ route('products.create') }}" class="btn btn-primary">+ Add New Product</a>
</div>

<table class="table table-striped table-hover shadow-sm rounded-3 overflow-hidden">    <thead style="background:#1F2937; color:white;">
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Name</th>
            <th>Category</th>
            <th>Active Weight</th>
            <th>Active Price</th>
            <th>Tax %</th>
            <th>Final Price</th>
            <th>All Rates</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
        @foreach($products as $product)
        <tr>
            <td>{{ $product->id }}</td>

            <td>
                @if($product->image)
                   <img src="{{ asset('storage/' . $product->image) }}" 

                         style="width: 60px; height: 60px; object-fit: cover;">
                @else
                    <span class="text-muted">No Image</span>
                @endif
            </td>

            <td>{{ $product->name }}</td>
            <td>{{ $product->category?->name ?? 'N/A' }}</td>

            <td>{{ $product->activeRate->weight ?? 'N/A' }}</td>
            <td>{{ $product->activeRate->price ?? 'N/A' }}</td>

            <td>{{ $product->tax_percent }}%</td>
            <td>Rs. {{ $product->final_price }}</td>

            <td>
                @foreach($product->rates as $rate)
                    <span class="badge bg-info">
                        {{ $rate->weight ?? 'N/A' }} ({{ $rate->price }})
                    </span><br>
                @endforeach
            </td>

            <td>
                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <a href="{{ route('product_rates.create', $product->id) }}" class="btn btn-success btn-sm">Add Rate</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
