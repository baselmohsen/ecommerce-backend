@extends('layouts.front.app')

@section('content')

<main class="main">

    <!-- Page Header -->
    <div class="page-header text-center" style="background-image: url('{{ asset('assets/images/page-header-bg.jpg') }}')">
        <div class="container">
            <h1 class="page-title">Shopping Cart<span>Shop</span></h1>
        </div>
    </div>

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Shop</a></li>
                <li class="breadcrumb-item active">Shopping Cart</li>
            </ol>
        </div>
    </nav>

    <div class="page-content">
        <div class="cart">
            <div class="container">
                <div class="row">

                    <!-- LEFT -->
                    <div class="col-lg-9">
                        <table class="table table-cart table-mobile">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                @php $total = 0; @endphp

                                @foreach($cartItems as $item)
                                    @php
                                        $subtotal = $item->quantity * $item->product->sale_price;
                                        $total += $subtotal;
                                    @endphp

                                    <tr>
                                        <td class="product-col">
                                            <div class="product">
                                                <figure class="product-media">
                                                    <a href="{{ route('product.show', $item->product->id) }}">
                                                        <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}">
                                                    </a>
                                                </figure>

                                                <h3 class="product-title">
                                                    <a href="{{ route('product.show', $item->product->id) }}">
                                                        {{ $item->product->name }}
                                                    </a>
                                                </h3>
                                            </div>
                                        </td>

                                        <td class="price-col">
                                            ${{ $item->product->sale_price }}
                                        </td>

                                        <td class="quantity-col">
                                            <input type="number"
                                                   class="form-control"
                                                   value="{{ $item->quantity }}"
                                                   min="1">
                                        </td>

                                        <td class="total-col">
                                            ${{ $subtotal }}
                                        </td>

                                        <td class="remove-col">
                                            <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn-remove">
                                                    <i class="icon-close"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>

                        <!-- Bottom -->
                        <div class="cart-bottom">
                            <div class="cart-discount">
                                <form>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="coupon code">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-primary-2" type="submit">
                                                <i class="icon-long-arrow-right"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <a href="#" class="btn btn-outline-dark-2">
                                <span>UPDATE CART</span>
                            </a>
                        </div>
                    </div>

                    <!-- RIGHT -->
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
                            <small>{{ $item->quantity }} x ${{ $item->product->sale_price }}</small>
                        </td>
                        <td>${{ $item->quantity * $item->product->sale_price }}</td>
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

        <!-- Payment Options -->
        

   
</aside>
                </div>
            </div>
        </div>
    </div>

</main>

@endsection

