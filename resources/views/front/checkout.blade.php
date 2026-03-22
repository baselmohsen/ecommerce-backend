@extends('layouts.front.app')

@section('content')

<x-breadcrumb title="Checkout" :links="[['name'=>'Checkout']]" />

<section class="checkout-wrapper section">
    <div class="container">
        <div class="row justify-content-center">

            <!-- LEFT: USER FORM -->
            <div class="col-lg-8">
                <div class="checkout-steps-form-style-1">

                    <!-- ERROR MESSAGES -->
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('checkout') }}">
                        @csrf

                        <div class="row">

                            <div class="col-md-6">
                                <input class="form-control mb-3" type="text" name="first_name" 
                                       placeholder="First Name" value="{{ old('first_name') }}" required>
                            </div>

                            <div class="col-md-6">
                                <input class="form-control mb-3" type="text" name="last_name" 
                                       placeholder="Last Name" value="{{ old('last_name') }}" required>
                            </div>

                            <div class="col-md-6">
                                <input class="form-control mb-3" type="email" name="email" 
                                       placeholder="Email" value="{{ old('email') }}" required>
                            </div>

                            <div class="col-md-6">
                                <input class="form-control mb-3" type="text" name="phone" 
                                       placeholder="Phone" value="{{ old('phone') }}" required>
                            </div>

                            <div class="col-md-12">
                                <input class="form-control mb-3" type="text" name="address" 
                                       placeholder="Address" value="{{ old('address') }}" required>
                            </div>

                            <div class="col-md-6">
                                <input class="form-control mb-3" type="text" name="city" 
                                       placeholder="City" value="{{ old('city') }}" required>
                            </div>
                        <div class="col-md-6">
                                <textarea class="form-control mb-3" name="notes" placeholder="Notes" rows="4">{{ old('notes', $order->notes ?? '') }}</textarea>
                            </div>

                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary w-100">Place Order</button>
                            </div>

                        </div>

                    </form>

                </div>
            </div>

            <!-- RIGHT: CART DETAILS -->
            <div class="col-lg-4">
                <div class="checkout-sidebar">

                    <div class="checkout-sidebar-price-table mt-30">
                        <h5 class="title">Your Cart</h5>

                        {{-- CART ITEMS --}}
                        @forelse($cartItems as $item)
                            <div class="d-flex mb-3 align-items-center">

                                <img width="60"
                                     src="{{ asset('storage/'.$item->product->image) }}"
                                     alt="product">

                                <div class="ms-2">
                                    <h6 class="mb-0">{{ $item->product->name }}</h6>
                                    <small>
                                        {{ $item->quantity }} x ${{ $item->product->sale_price }}
                                    </small>
                                </div>

                                <div class="ms-auto">
                                    ${{ $item->total }}
                                </div>

                            </div>
                        @empty
                            <p>No items in cart</p>
                        @endforelse

                        <hr>

                        {{-- TOTAL --}}
                        <div class="total-payable">
                            <div class="payable-price d-flex justify-content-between">
                                <p>Total:</p>
                                <strong>${{ $total }}</strong>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

@endsection