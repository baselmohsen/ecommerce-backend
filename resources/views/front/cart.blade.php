@extends('layouts.front.app')

@section('content')

<main class="main">

    <!-- Page Header -->
    <div class="page-header text-center" style="background-image: url('{{ asset('assets/images/page-header-bg.jpg') }}')">
        <div class="container">
            <h1 class="page-title">
                {{ __('shopping cart') }} <span>{{ __('shop') }}</span>
            </h1>
        </div>
    </div>

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">{{ __('home') }}</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="#">{{ __('shop') }}</a>
                </li>
                <li class="breadcrumb-item active">
                    {{ __('shopping cart') }}
                </li>
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
                                    <th>{{ __('product') }}</th>
                                    <th>{{ __('price') }}</th>
                                    <th>{{ __('quantity') }}</th>
                                    <th>{{ __('total') }}</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                         
                                @foreach($cartItems as $item)
                            
                                    <tr>
                                        <td class="product-col">
                                            <div class="product">
                                                <figure class="product-media">
                                                    <a href="{{ route('product.show', $item->product->id) }}">
                                                        <img src="{{ $item->product->image_url }}" alt="{{ $item->product->name }}">
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
                                                <div class="cart-product-quantity">
                                                    <input type="number"  class="form-control btn-quantity" data-id="{{$item->id}}"  value="{{ $item->quantity }}" min="1" max="10" step="1" data-decimals="0" required>
                                                </div>                              
                                            </td>
                                        <td class="total-col">
                                            ${{ $item->total }}
                                        </td>

                                        <td class="remove-col">
                                  

                                             <button class="btn-remove btn-remove-cart" data-id="{{$item->id}}">
                                                    <i class="icon-close"></i>
                                                </button>
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
                                        <input type="text" class="form-control" placeholder="{{ __('coupon code') }}">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-primary-2" type="submit">
                                                <i class="icon-long-arrow-right"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <a href="#" class="btn btn-outline-dark-2">
                                <span>{{ __('update cart') }}</span>
                            </a>
                        </div>
                    </div>

                 
                </div>
            </div>
        </div>
    </div>

</main>

@endsection


@push('scripts')
    <script>
$('.btn-remove-cart').click(function () {
    let id = $(this).data('id');
    let row = $(this).closest('tr');

    $.ajax({
        url: "cart/remove/" + id,
        method: "POST",
        data: {
            _token: "{{ csrf_token() }}",
            _method: "DELETE"
        },
        success: function () {
            row.remove(); 
        },
        error: function () {
                        Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'error',
                        title: res.message,
                        showConfirmButton: false,
                        timer: 3000,
                    });
        }
    });
});
$(document).on('change', '.btn-quantity', function () {

    let input = $(this);
    let id = input.data('id');
    let quantity = input.val();
    let row = input.closest('tr');

    $.ajax({
        url: "/cart/update/" + id,
        method: "POST",
        data: {
            _token: "{{ csrf_token() }}",
            _method: "PUT",
            quantity: quantity
        },
        success: function (res) {

            // تحديث total بتاع الصف
            row.find('.total-col').text('$' + res.item_total);

            // // تحديث total الكلي
            // $('.summary-total td:last').text('$' + res.cart_total);

            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: res.message,
                showConfirmButton: false,
                timer: 2000,
            });
        },
        error: function (res) {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'error',
                title: res.message,
                showConfirmButton: false,
                timer: 2000,
            });
        }
    });
});
    </script>
@endpush