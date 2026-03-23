@extends('layouts.front.app')

@section('content')

<div class="soon d-flex align-items-center justify-content-center" style="min-height: 80vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="soon-content text-center">
                    <div class="soon-content-wrapper">

                        <img src="{{ asset('assets/images/logo-icon.png') }}" alt="Logo" class="soon-logo mx-auto mb-3">

                        <h1 class="soon-title text-success">🎉 Order Placed Successfully!</h1>

                        <hr class="mt-3 mb-3">

                        <p>
                            Thank you for your purchase. Your order has been received and is being processed.
                        </p>

                        {{-- ORDER INFO --}}
                        @if(session('order'))
                            <div class="card mt-3 mb-3 text-center">
                                <div class="card-body">
                                    <p><strong>Order ID:</strong> #{{ session('order')->id }}</p>
                                    <p><strong>Total:</strong> ${{ session('order')->total }}</p>
                                    <p><strong>Status:</strong> 
                                        <span class="badge badge-success">
                                            {{ ucfirst(session('order')->status) }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                        @endif

                        {{-- ACTION BUTTONS --}}
                        <div class="mt-4 d-flex justify-content-center gap-2">
                            <a href="{{ route('profile') }}" class="btn btn-primary mr-2">
                                View My Orders
                            </a>

                            <a href="{{ route('home') }}" class="btn btn-outline-primary-2">
                                Continue Shopping
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection