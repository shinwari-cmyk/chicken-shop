@extends('layouts.app')

@section('content')
<div class="container py-5">

    <!-- Header -->
    <div class="text-center mb-5">
        <h1 class="fw-bold text-danger">📞 Get in Touch</h1>
        <p class="text-muted">
            Have a question or feedback? We’d love to hear from you.
        </p>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">

            <!-- Card -->
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-4 p-md-5">

                    <!-- Success Message -->
                    @if(session('success'))
                        <div class="alert alert-success text-center fw-semibold">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Validation Errors -->
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Form -->
                    <form action="{{ route('contact.send') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                👤 Your Name
                            </label>
                            <input
                                type="text"
                                name="name"
                                class="form-control form-control-lg"
                                placeholder="Enter your name"
                                value="{{ old('name') }}"
                                required
                            >
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                📧 Email Address
                            </label>
                            <input
                                type="email"
                                name="email"
                                class="form-control form-control-lg"
                                placeholder="Enter your email"
                                value="{{ old('email') }}"
                                required
                            >
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                💬 Message
                            </label>
                            <textarea
                                name="message"
                                rows="4"
                                class="form-control form-control-lg"
                                placeholder="Write your message here..."
                                required
                            >{{ old('message') }}</textarea>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-danger btn-lg rounded-pill">
                                🚀 Send Message
                            </button>
                        </div>
                    </form>

                </div>
            </div>

            <!-- Footer note -->
            <p class="text-center text-muted mt-4">
                We usually reply within 24 hours ⏱️
            </p>

        </div>
    </div>
</div>
@endsection
