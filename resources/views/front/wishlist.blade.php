@extends('layouts.front.app')

@section('content')
<main class="main">
    <!-- Page Header -->
    <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">Wishlist<span>Shop</span></h1>
        </div>
    </div>

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Shop</a></li>
                <li class="breadcrumb-item active" aria-current="page">Wishlist</li>
            </ol>
        </div>
    </nav>

    <!-- Page Content -->
    <div class="page-content">
        <div class="container">

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if($wishlistItems->count() > 0)
                <table class="table table-wishlist table-mobile">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Stock Status</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($wishlistItems as $item)
                        <tr>
                            <!-- Product Info -->
                            <td class="product-col">
                                <div class="product">
                                    <figure class="product-media">
                                        <a href="{{ route('product.show', $item->product->id) }}">
                                            <img src="{{ $item->product->image_url }}" alt="{{ $item->product->name }}">
                                        </a>
                                    </figure>
                                    <h3 class="product-title">
                                        <a href="{{ route('product.show', $item->product->slug) }}">{{ $item->product->name }}</a>
                                    </h3>
                                </div>
                            </td>

                            <!-- Price -->
                            <td class="price-col">${{ $item->product->sale_price ?? $item->product->price }}</td>

                            <!-- Stock Status -->
                            <td class="stock-col">
                                @if($item->product->stock > 0)
                                    <span class="in-stock">In stock</span>
                                @else
                                    <span class="out-of-stock">Out of stock</span>
                                @endif
                            </td>

                            <!-- Add to Cart / Options -->
                            <td class="action-col">
                                @if($item->product->stock > 0)
                                    <form id="add_to_cart_{{ $item->product->id }}" action="{{ route('cart') }}" method="POST" style="display:none;">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $item->product->id }}">
                                    </form>
                                    <button class="btn btn-block btn-outline-primary-2" 
                                            onclick="document.getElementById('add_to_cart_{{ $item->product->id }}').submit()">
                                        <i class="icon-cart-plus"></i> Add to Cart
                                    </button>
                                @else
                                    <button class="btn btn-block btn-outline-primary-2 disabled">Out of Stock</button>
                                @endif
                            </td>

                            <!-- Remove from Wishlist -->
                            <td class="remove-col">
                                <form id="remove_wishlist_{{ $item->id }}" action="{{ route('wishlist.remove', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <button class="btn-remove" onclick="document.getElementById('remove_wishlist_{{ $item->id }}').submit()">
                                    <i class="icon-close"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Wishlist Share -->
                <div class="wishlist-share mt-4">
                    <div class="social-icons social-icons-sm mb-2">
                        <label class="social-label">Share on:</label>
                        <a href="#" class="social-icon" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                        <a href="#" class="social-icon" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                        <a href="#" class="social-icon" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                        <a href="#" class="social-icon" title="Youtube" target="_blank"><i class="icon-youtube"></i></a>
                        <a href="#" class="social-icon" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a>
                    </div>
                </div>

            @else
                <p>Your wishlist is empty.</p>
            @endif

        </div>
    </div>
</main>
@endsection