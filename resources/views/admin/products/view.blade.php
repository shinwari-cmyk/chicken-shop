@extends('layouts.layout')

@section('content')
<div class="container mt-4">

    <h2 class="mb-3">{{ $product->name }} — Rates</h2>

    <a href="{{ route('product_rates.index', $product->id) }}" class="btn btn-primary mb-3">
        Manage Rates
    </a>

    @if($rates->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Weight</th>
                    <th>Price</th>
                    <th>Active</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rates as $rate)
                    <tr>
                        <td>{{ $rate->weight }}g</td>
                        <td>{{ $rate->price }}</td>
                        <td>
                            @if($rate->active)
                                ✅ Active
                            @else
                                ❌
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No rates yet.</p>
    @endif

</div>
@endsection
