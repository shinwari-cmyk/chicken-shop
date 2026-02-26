@extends('layouts.app')

@section('content')
<div class="container">
  <h2 class="mb-4">Categories</h2>
  <a href="{{ route('categories.create') }}" class="btn btn-success mb-3">Add Category</a>

  @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif

  <div class="row g-3">
    @foreach($categories as $cat)
      <div class="col-md-4">
        <div class="card shadow-sm">
          <div class="card-body d-flex justify-content-between align-items-center">
            <div>{{ $cat->name }}</div>
            <div>
              <a class="btn btn-sm btn-primary" href="{{ route('categories.edit',$cat->id) }}">Edit</a>
              <form action="{{ route('categories.destroy',$cat->id) }}" method="POST" class="d-inline">
                @csrf @method('DELETE')
                <button class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>
@endsection
