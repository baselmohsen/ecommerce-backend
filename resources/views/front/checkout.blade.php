@extends('layouts.front.app')

@section('content')

<main class="main">

    <!-- Header -->
    <div class="page-header text-center"
         style="background-image: url('{{ asset('assets/images/page-header-bg.jpg') }}')">
        <div class="container">
            <h1 class="page-title">
                {{ __('checkout') }} <span>{{ __('shop') }}</span>
            </h1>
        </div>
    </div>

    <!-- Breadcrumb -->
    <nav class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">{{ __('home') }}</a>
                </li>
                <li class="breadcrumb-item active">
                    {{ __('checkout') }}
                </li>
            </ol>
        </div>
    </nav>

    <div class="page-content">
        <div class="checkout">
            <div class="container">

           
           
                <form method="POST" action="{{ route('checkout') }}">
                    @csrf

                    <div class="row">

                        <!-- LEFT -->
                        <div class="col-lg-9">
                            <h2 class="checkout-title">{{ __('billing details') }}</h2>

                            <div class="row">
                                <div class="col-sm-6">
                                    <input type="text" name="first_name"
                                           class="form-control"
                                           placeholder="{{ __('first name') }}"
                                           value="{{ old('first_name') }}" required>
                                </div>

                                <div class="col-sm-6">
                                    <input type="text" name="last_name"
                                           class="form-control"
                                           placeholder="{{ __('last name') }}"
                                           value="{{ old('last_name') }}" required>
                                </div>
                            </div>

                            <input type="email" name="email"
                                   class="form-control"
                                   placeholder="{{ __('email') }}"
                                   value="{{ old('email') }}" required>

                            <input type="text" name="phone"
                                   class="form-control"
                                   placeholder="{{ __('phone') }}"
                                   value="{{ old('phone') }}" required>

                            <input type="text" name="address"
                                   class="form-control"
                                   placeholder="{{ __('address') }}"
                                   value="{{ old('address') }}" required>

                            <div class="row">
                                <div class="col-sm-6">
                                    <input type="text" name="city"
                                           class="form-control"
                                           placeholder="{{ __('city') }}"
                                           value="{{ old('city') }}" required>
                                </div>
                            </div>

                            <textarea name="notes"
                                      class="form-control"
                                      rows="4"
                                      placeholder="{{ __('order notes') }}">{{ old('notes') }}</textarea>

                        </div>

                        <!-- RIGHT -->
                        <aside class="col-lg-3">
                            <div class="summary">
                                <h3 class="summary-title">{{ __('your order') }}</h3>

                                <table class="table table-summary">
                                    <thead>
                                        <tr>
                                            <th>{{ __('product') }}</th>
                                            <th>{{ __('total') }}</th>
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
                                                <td colspan="2">{{ __('empty cart') }}</td>
                                            </tr>
                                        @endforelse

                                        <tr class="summary-total">
                                            <td>{{ __('total') }}:</td>
                                            <td>${{ $total }}</td>
                                        </tr>
                                    </tbody>
                                </table>

                                <!-- PAYMENT -->
                                <div class="accordion-summary">

                                    <div class="card">
                                        <div class="card-header">
                                            <h2 class="card-title">
                                                <input type="radio" name="payment_method" value="cod" checked>
                                                {{ __('cash on delivery') }}
                                            </h2>
                                        </div>
                                    </div>


                                </div>

                                <button type="submit"
                                        class="btn btn-outline-primary-2 btn-order btn-block">
                                    {{ __('place order') }}
                                </button>

                            </div>

                            <a href="{{ route('cart') }}"
                               class="btn btn-outline-dark-2 btn-block mt-2">
                                {{ __('back to cart') }}
                            </a>

                        </aside>

                    </div>
                </form>

            </div>
        </div>
    </div>

</main>

@endsection