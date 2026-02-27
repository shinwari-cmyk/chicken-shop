@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Product</h2>

    <form action="{{ route('products.update', $product->id) }}" 
          method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control"
                   value="{{ $product->name }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Category</label>
            <select name="category_id" class="form-select">
                @foreach($categories as $c)
                    <option value="{{ $c->id }}"
                        {{ $product->category_id == $c->id ? 'selected' : '' }}>
                        {{ $c->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Price</label>
            <input type="number" step="0.01" name="price" class="form-control"
                   value="{{ $product->price }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Tax %</label>
            <input type="number" step="0.01" name="tax_percent" class="form-control"
                   value="{{ $product->tax_percent }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Current Image</label><br>

            @if($product->image)
                <img src="{{ asset('storage/'.$product->image) }}" width="120" class="mb-2">
            @else
                No Image
            @endif

            <input type="file" name="image" class="form-control mt-2">
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control">
                {{ $product->description }}
            </textarea>
        </div>

        <button class="btn btn-primary">Update Product</button>
    </form>
</div>
@endsection
