@extends('layouts.front.app')

@section('content')




   <!-- Shopping Cart -->
    <div class="shopping-cart section">
        <div class="container">
            <div class="cart-list-head">
                <!-- Cart List Title -->
                <div class="cart-list-title">
                    <div class="row">
                        <div class="col-lg-1 col-md-1 col-12">

                        </div>
                        <div class="col-lg-4 col-md-3 col-12">
                            <p>Product Name</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>Quantity</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>Subtotal</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>Discount</p>
                        </div>
                        <div class="col-lg-1 col-md-2 col-12">
                            <p>Remove</p>
                        </div>
                    </div>
                </div>
                <!-- End Cart List Title -->
                <!-- Cart Single List list -->

            @foreach($cartItems as $item)
        <div class="cart-single-list">
            <div class="row align-items-center">
                <div class="col-lg-1 col-md-1 col-12">
                    <a href="{{ route('product.show', $item->product->id) }}">
                        <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}">
                    </a>
                </div>
                <div class="col-lg-4 col-md-3 col-12">
                    <h5 class="product-name">
                        <a href="{{ route('product.show', $item->product->id) }}">
                            {{ $item->product->name }}
                        </a>
                    </h5>
                    <p class="product-des">
                        <span><em>Type:</em> {{ $item->product->type ?? '-' }}</span>
                        <span><em>Color:</em> {{ $item->product->color ?? '-' }}</span>
                    </p>
                </div>
                <div class="col-lg-2 col-md-2 col-12">
                    <div class="count-input">
                        <select class="form-control">
                            @for($i=1; $i<=10; $i++)
                                <option value="{{ $i }}" @if($i==$item->quantity) selected @endif>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-12">
                    <p>${{ $item->product->sale_price }}</p>
                </div>
                <div class="col-lg-2 col-md-2 col-12">
                    <p>${{ $item->quantity * $item->product->sale_price }}</p>
                </div>
                <div class="col-lg-1 col-md-2 col-12">
                    <a class="remove-item" href="#">
                        <i class="lni lni-close"></i>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
                <!-- End Single List list -->
            </div>
            <div class="row">
                <div class="col-12">
                    <!-- Total Amount -->
                    <div class="total-amount">
                        <div class="row">
                            <div class="col-lg-8 col-md-6 col-12">
                                <div class="left">
                                    <div class="coupon">
                                        <form action="#" target="_blank">
                                            <input name="Coupon" placeholder="Enter Your Coupon">
                                            <div class="button">
                                                <button class="btn">Apply Coupon</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="right">
                                    <ul>
                                        <li>Cart total<span>  ${{$total}}</span></li>
                             
                                    </ul>
                                    <div class="button">
                                        <a href="{{route('checkout')}}" class="btn">Checkout</a>
                                        <a href="product-grids.html" class="btn btn-alt">Continue shopping</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ End Total Amount -->
                </div>
            </div>
        </div>
    </div>
    <!--/ End Shopping Cart -->
@endsection
