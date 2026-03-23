@extends('layouts.front.app')

@section('content')

<main class="main">

    <div class="mb-3 mb-lg-5"></div>

    <div class="banner-group">
    <div class="container">
    <div class="row">

        {{-- FIRST BIG CATEGORY --}}
        @if($categories->count() > 0)
        <div class="col-md-12 col-lg-5">
            <div class="banner banner-large banner-overlay banner-overlay-light">
                <a href="#">
                            <img src="{{ asset('assets/images/demos/demo-2/banners/banner-1.jpg') }}" alt="Banner">
                </a>
                <div class="banner-content banner-content-top">
                    <h4 class="banner-subtitle">Category</h4>
                    <h3 class="banner-title">{{ $categories[0]->name }}</h3>
                    <div class="banner-text">
                        {{ $categories[0]->products->count() }} Products
                    </div>
                    <a href="#" class="btn btn-outline-gray banner-link">
                        Shop Now <i class="icon-long-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
        @endif


        {{-- SECOND CATEGORY --}}
        @if($categories->count() > 1)
        <div class="col-md-6 col-lg-3">
            <div class="banner banner-overlay">
                <a href="#">
                            <img src="{{ asset('assets/images/demos/demo-2/banners/banner-1.jpg') }}" alt="Banner">
                </a>
                <div class="banner-content banner-content-bottom">
                    <h4 class="banner-subtitle text-grey">Top Category</h4>
                    <h3 class="banner-title text-white">{{ $categories[1]->name }}</h3>
                    <div class="banner-text text-white">
                        {{ $categories[1]->products->count() }} Items
                    </div>
                    <a href="#" class="btn btn-outline-white banner-link">
                        Discover Now <i class="icon-long-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
        @endif


        {{-- THIRD + FOURTH --}}
        <div class="col-md-6 col-lg-4">

            @if($categories->count() > 2)
            <div class="banner banner-overlay">
                <a href="#">
                            <img src="{{ asset('assets/images/demos/demo-2/banners/banner-1.jpg') }}" alt="Banner">
                </a>
                <div class="banner-content banner-content-top">
                    <h4 class="banner-subtitle text-grey">Explore</h4>
                    <h3 class="banner-title text-white">{{ $categories[2]->name }}</h3>
                    <a href="#" class="btn btn-outline-white banner-link">
                        Discover Now <i class="icon-long-arrow-right"></i>
                    </a>
                </div>
            </div>
            @endif

            @if($categories->count() > 3)
            <div class="banner banner-overlay banner-overlay-light">
                <a href="#">
                            <img src="{{ asset('assets/images/demos/demo-2/banners/banner-1.jpg') }}" alt="Banner">
                </a>
                <div class="banner-content banner-content-top">
                    <h4 class="banner-subtitle">Popular</h4>
                    <h3 class="banner-title">{{ $categories[3]->name }}</h3>
                    <div class="banner-text">
                        {{ $categories[3]->products->count() }} Products
                    </div>
                    <a href="#" class="btn btn-outline-gray banner-link">
                        Shop Now <i class="icon-long-arrow-right"></i>
                    </a>
                </div>
            </div>
            @endif

        </div>

    </div>
</div>
    </div>

    <div class="mb-5"></div>

    <div class="container">
        <div class="heading heading-center mb-3">
            <h2 class="title">Top Selling Products</h2>
        </div>

         <div class="tab-content">

           <!-- ALL PRODUCTS -->
            <div class="tab-pane fade show active" id="top-all-tab">
                <div class="row justify-content-center">
                    @foreach($products as $product)
                    <div class="col-6 col-md-4 col-lg-3 col-xl-5col">
                        <div class="product product-11 text-center">
                            <figure class="product-media">
                                <a href="{{ route('product.show', $product->slug) }}">
                                    <!-- Default image if not found -->
                                    <img src="{{ asset($product->image ? 'storage/'.$product->image : 'assets/images/default-product.jpg') }}" 
                                        alt="{{ $product->name }}" class="product-image">
                                    <!-- Hover image: optional, if you have second image -->
                                    @if($product->second_image)
                                        <img src="{{ asset('storage/'.$product->second_image) }}" 
                                            alt="{{ $product->name }}" class="product-image-hover">
                                    @endif
                                </a>

                                <div class="product-action-vertical">
                                    <a href="#" class="btn-product-icon btn-wishlist"><span>add to wishlist</span></a>
                                </div><!-- End .product-action-vertical -->
                            </figure><!-- End .product-media -->

                            <div class="product-body">
                                <div class="product-cat">
                                    <a href="#">{{ $product->category->name ?? 'No Category' }}</a>
                                </div><!-- End .product-cat -->
                                <h3 class="product-title">
                                    <a href="{{ route('product.show', $product->slug) }}">{{ $product->name }}</a>
                                </h3><!-- End .product-title -->
                                <div class="product-price">
                                    ${{ $product->sale_price }}
                                    @if($product->price > $product->sale_price)
                                        <span class="discount-price">${{ $product->price }}</span>
                                    @endif
                                </div><!-- End .product-price -->
                            </div><!-- End .product-body -->

                            <!-- Add to cart form -->
                            <form id="add_to_cart_{{ $product->id }}" action="{{ route('cart') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                            </form>

                            <div class="product-action">
                                <a href="javascript:;" 
                                onclick="document.getElementById('add_to_cart_{{ $product->id }}').submit()" 
                                class="btn-product btn-cart">
                                    <span>add to cart</span>
                                </a>
                            </div><!-- End .product-action -->
                        </div><!-- End .product -->
                    </div><!-- End .col -->
                    @endforeach
                </div><!-- End .row -->
            </div><!-- End .tab-pane -->
         </div>
    </div>

    <div class="container">
        <hr class="mt-1 mb-6">
    </div>

</main>

@endsection
  
   