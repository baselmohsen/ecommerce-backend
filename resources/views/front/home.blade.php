@extends('layouts.front.app')

@section('content')

<main class="main">

    <div class="mb-3 mb-lg-5"></div>

    <div class="banner-group">
       <div class="container">
    <div class="row">

        
      <div class="mb-3 mb-lg-5"></div>
      
      <div class="banner-group">
            <div class="heading heading-center mb-3">
                        <h2 class="title">Our Categories</h2>
                    </div>
            <div class="container">
                <div class="row">

                    @forelse($categories as $category)
                        <div class="col-md-6 col-lg-3">
                            <div class="banner banner-overlay">
                                <a href="{{ route('category.products', $category->id) }}">
                                    <img src="{{ asset('assets/images/demos/demo-2/banners/banner-1.jpg') }}" alt="{{ $category->name }}">
                                </a>
                                <div class="banner-content banner-content-bottom">
                                    <h4 class="banner-subtitle text-grey">Top Category</h4>
                                    <h3 class="banner-title text-white">{{ $category->name }}</h3>
                                    <div class="banner-text text-white">
                                        {{ $category->products->count() }} Items
                                    </div>
                                    <a href="{{ route('category.products', $category->id) }}" class="btn btn-outline-white banner-link">
                                        Discover Now <i class="icon-long-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-4">
                            <p>No categories found.</p>
                        </div>
                    @endforelse

                </div>
            </div>
        </div>
    </div>
</div>
    </div>

    <div class="mb-5"></div>

    <div class="container">
        <div class="heading heading-center mb-3">
            <h2 class="title">The Latest Products</h2>
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

                                                                    <!-- Hidden form for wishlist -->
                                    <form id="add_to_wishlist_{{ $product->id }}" action="{{ route('wishlist') }}" method="POST" style="display: none;">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    </form>

                                    <!-- Wishlist button -->
                                    <div class="product-action-vertical">
                                        <a href="javascript:;" 
                                        onclick="document.getElementById('add_to_wishlist_{{ $product->id }}').submit()" 
                                        class="btn-product-icon btn-wishlist">
                                            <span>Add to Wishlist</span>
                                        </a>
                                    </div>
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
  
   