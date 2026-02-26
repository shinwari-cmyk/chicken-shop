@extends('layouts.app')

@section('content')
<div class="container">
  <h2>Edit Category</h2>
  <form action="{{ route('categories.update', $category->id) }}" method="POST">
    @csrf @method('PUT')
    <div class="mb-3">
      <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
    </div>
    <button class="btn btn-primary">Update</button>
  </form>
</div>
@endsection
