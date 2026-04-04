@extends('layouts.front.app')

@section('content')

<main class="main">

    <div class="mb-3 mb-lg-5"></div>


    {{-- ===========================
        SHOP BY CATEGORIES BANNERS (Carousel)
    ============================ --}}
        <div class="container categories pt-6">
            <h2 class="title-lg text-center mb-4">{{ __('Shop by Categories') }}</h2>

            <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl"
                data-owl-options='{
                    "nav": false,
                    "dots": true,
                    "margin": 20,
                    "loop": false,
                    "responsive": {
                        "0": {"items":1},
                        "480": {"items":2},
                        "768": {"items":3},
                        "992": {"items":4},
                        "1200": {"items":4, "nav": true, "dots": false}
                    }
                }'>
                @foreach($categories as $category)
                    <div class="banner banner-display banner-link-anim text-center">
                        <a href="{{ route('category.products', $category->id) }}">
                            <img src="{{ $category->image_url }}" alt="{{ $category->name }}">
                        </a>
                        <div class="banner-content banner-content-center">
                            <h3 class="banner-title text-white">
                                <a href="{{ route('category.products', $category->id) }}">{{ $category->name }}</a>
                            </h3>
                            <a href="{{ route('category.products', $category->id) }}" class="btn btn-outline-white banner-link">
                                Shop Now <i class="icon-long-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    <div class="mb-6"></div>



    {{-- ===========================
        TRENDY PRODUCTS CAROUSEL
    ============================ --}}
    <div class="container">
        <div class="heading heading-center mb-3">
            <h2 class="title-lg">{{ __('Trendy Products') }}</h2>
        </div>
        <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl" 
            data-owl-options='{
                "nav": false, 
                "dots": true,
                "margin": 20,
                "loop": false,
                "responsive": {
                    "0": {"items":2},
                    "480": {"items":2},
                    "768": {"items":3},
                    "992": {"items":4},
                    "1200": {"items":4,"nav": true,"dots": false}
                }
            }'>
            @foreach($trendyProducts as $product)
            <div class="product product-11 text-center">
                <figure class="product-media">
                    <a href="{{ route('product.show', $product->slug) }}">
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="product-image">
                    </a>
                    <div class="product-action-vertical">
                        <a href="javascript:;" data-id="{{ $product->id }}" class="btn-product-icon btn-wishlist">
                            <span>{{ __('Add to Wishlist') }}</span>
                        </a>
                    </div>
                </figure>
                <div class="product-body">
                    <h3 class="product-title">
                        <a href="{{ route('product.show', $product->slug) }}">{{ $product->name }}</a>
                    </h3>
                    <div class="product-price">
                        ${{ $product->sale_price }}
                        @if($product->price > $product->sale_price)
                            <span class="discount-price">${{ $product->price }}</span>
                        @endif
                    </div>
                </div>
                <div class="product-action">
                    <a href="javascript:;" data-id="{{ $product->id }}" class="btn-product btn-cart {{ $product->stock <= 0 ? 'disable' : '' }}">
                        <span>{{ $product->stock <= 0 ? __('Out of Stock') : __('Add to Cart') }}</span>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="mb-6"></div>

    {{-- ===========================
        RECENT ARRIVALS
    ============================ --}}
    <div class="container">
        <div class="heading heading-center mb-3">
            <h2 class="title-lg">{{ __('Recent Arrivals') }}</h2>
        </div>
        <div class="row justify-content-center">
            @foreach($recentArrivals as $product)
            <div class="col-6 col-md-4 col-lg-3">
                <div class="product product-11 text-center">
                    <figure class="product-media">
                        <a href="{{ route('product.show', $product->slug) }}">
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="product-image">
                        </a>
                        <div class="product-action-vertical">
                            <a href="javascript:;" data-id="{{ $product->id }}" class="btn-product-icon btn-wishlist">
                                <span>{{ __('Add to Wishlist') }}</span>
                            </a>
                        </div>
                    </figure>
                    <div class="product-body">
                        <h3 class="product-title">
                            <a href="{{ route('product.show', $product->slug) }}">{{ $product->name }}</a>
                        </h3>
                        <div class="product-price">
                            ${{ $product->sale_price }}
                            @if($product->price > $product->sale_price)
                                <span class="discount-price">${{ $product->price }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="product-action">
                        <a href="javascript:;" data-id="{{ $product->id }}" class="btn-product btn-cart {{ $product->stock <= 0 ? 'disable' : '' }}">
                            <span>{{ $product->stock <= 0 ? __('Out of Stock') : __('Add to Cart') }}</span>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="mb-6"></div>

</main>

@endsection
