@extends('layouts.front.app')

@section('content')

<main class="main">

    <!-- Header -->
    <div class="page-header text-center"
         style="background-image: url('{{ asset('assets/images/page-header-bg.jpg') }}')">
        <div class="container">
            <h1 class="page-title">Checkout<span>Shop</span></h1>
        </div>
    </div>

    <!-- Breadcrumb -->
    <nav class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Checkout</li>
            </ol>
        </div>
    </nav>

    <div class="page-content">
        <div class="checkout">
            <div class="container">

                {{-- ERRORS --}}
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
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

                        <!-- LEFT: FORM -->
                        <div class="col-lg-9">
                            <h2 class="checkout-title">Billing Details</h2>

                            <div class="row">
                                <div class="col-sm-6">
                                    <input type="text" name="first_name"
                                           class="form-control"
                                           placeholder="First Name"
                                           value="{{ old('first_name') }}" required>
                                </div>

                                <div class="col-sm-6">
                                    <input type="text" name="last_name"
                                           class="form-control"
                                           placeholder="Last Name"
                                           value="{{ old('last_name') }}" required>
                                </div>
                            </div>

                            <input type="email" name="email"
                                   class="form-control"
                                   placeholder="Email"
                                   value="{{ old('email') }}" required>

                            <input type="text" name="phone"
                                   class="form-control"
                                   placeholder="Phone"
                                   value="{{ old('phone') }}" required>

                            <input type="text" name="address"
                                   class="form-control"
                                   placeholder="Address"
                                   value="{{ old('address') }}" required>

                            <div class="row">
                                <div class="col-sm-6">
                                    <input type="text" name="city"
                                           class="form-control"
                                           placeholder="City"
                                           value="{{ old('city') }}" required>
                                </div>

                           
                            </div>

                            <textarea name="notes"
                                      class="form-control"
                                      rows="4"
                                      placeholder="Order Notes">{{ old('notes') }}</textarea>

                        </div>

                        <!-- RIGHT: ORDER SUMMARY -->
                        <aside class="col-lg-3">
                            <div class="summary">
                                <h3 class="summary-title">Your Order</h3>

                                <table class="table table-summary">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                       
                                        @forelse($cartItems as $item)
                                          

                                            <tr>
                                                <td>
                                                    {{ $item->product->name }}
                                                    <br>
                                                    <small>
                                                        {{ $item->quantity }} x ${{ $item->product->sale_price }}
                                                    </small>
                                                </td>
                                                <td>${{ $item->total }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="2">No items in cart</td>
                                            </tr>
                                        @endforelse

                                       

                                        <tr class="summary-total">
                                            <td>Total:</td>
                                            <td>${{ $total }}</td>
                                        </tr>
                                    </tbody>
                                </table>

                                <!-- PAYMENT -->
                                <div class="accordion-summary" id="accordion-payment">

                                    <div class="card">
                                        <div class="card-header">
                                            <h2 class="card-title">
                                                <input type="radio" name="payment_method" value="cod" checked>
                                                Cash on Delivery
                                            </h2>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-header">
                                            <h2 class="card-title">
                                                <input type="radio" name="payment_method" value="bank">
                                                Bank Transfer
                                            </h2>
                                        </div>
                                    </div>

                                </div>

                                <button type="submit"
                                        class="btn btn-outline-primary-2 btn-order btn-block">
                                    Place Order
                                </button>

                            </div>

                            <a href="{{ route('cart') }}"
                               class="btn btn-outline-dark-2 btn-block mt-2">
                                Back to Cart
                            </a>

                        </aside>

                    </div>
                </form>

            </div>
        </div>
    </div>

</main>

@endsection