@extends('layouts.app')

@section('content')
<div class="container">
  <h2 class="mb-3">Rates for: {{ $product->name }}</h2>

  <a href="{{ route('product_rates.create', $product->id) }}" class="btn btn-success mb-3">Add Rate</a>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <div class="card">
    <div class="card-body">
      <table class="table table-hover">
        <thead class="table-danger">
          <tr>
            <th>#</th>
            <th>Price</th>
            <th>Weight</th>
            <th>Active</th>
            <th>Note</th>
            <th>Date</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @forelse($rates as $rate)
            <tr>
              <td>{{ $rate->id }}</td>
              <td>Rs. {{ $rate->price }}</td>
              <td>{{ $rate->weight ?? '-' }}</td>
              <td>
                @if($rate->active)
                  <span class="badge bg-success">Active</span>
                @else
                  <span class="badge bg-secondary">No</span>
                @endif
              </td>
              <td>{{ $rate->note ?? '-' }}</td>
              <td>{{ $rate->created_at->format('d M Y h:i A') }}</td>
              <td>
                <a class="btn btn-sm btn-primary" href="{{ route('product_rates.edit', $rate->id) }}">Edit</a>
                <form action="{{ route('product_rates.destroy', $rate->id) }}" method="POST" class="d-inline">
                  @csrf @method('DELETE')
                  <button class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</button>
                </form>
              </td>
            </tr>
          @empty
            <tr><td colspan="7" class="text-muted">No rates yet.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
