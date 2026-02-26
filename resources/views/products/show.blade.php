@extends('layouts.layout')

@section('content')
<div class="container mt-5">

    <a href="{{ route('products.index') }}" class="btn btn-secondary mb-3">← Back</a>

    <h2>{{ $product->name }}</h2>

    <p><strong>Category:</strong> {{ $product-> ->name ?? 'No Category' }}</p>

    @if($product->activeRate)
        <p><strong>Active Price:</strong> Rs {{ $product->activeRate->price }}</p>
        <p><strong>Weight:</strong> {{ $product->activeRate->weight }} kg</p>
    @else
        <p class="text-danger">No Active Rate</p>
    @endif

    <hr>

    <h4>Available Rates</h4>

    <table class="table table-bordered">
        <thead class="table-danger">
            <tr>
                <th>Price</th>
                <th>Weight</th>
                <th>Active</th>
                <th width="150">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($product->rates as $rate)
            <tr>
                <td>Rs {{ $rate->price }}</td>
                <td>{{ $rate->weight }} kg</td>
                <td>{{ $rate->active ? '✅ Yes' : '❌ No' }}</td>
                <td>
                    <a href="{{ route('product_rates.edit', $rate->id) }}" class="btn btn-primary btn-sm">Edit</a>

                    <form action="{{ route('product_rates.destroy', $rate->id) }}" method="POST"
                        style="display:inline-block">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Delete this rate?')" class="btn btn-danger btn-sm">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
