@extends('layouts.front.app')

@section('content')
    <main class="main">
            <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
                <div class="container d-flex align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Products</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Default</li>
                    </ol>

                    <nav class="product-pager ml-auto" aria-label="Product">
                        <a class="product-pager-link product-pager-prev" href="#" aria-label="Previous" tabindex="-1">
                            <i class="icon-angle-left"></i>
                            <span>Prev</span>
                        </a>

                        <a class="product-pager-link product-pager-next" href="#" aria-label="Next" tabindex="-1">
                            <span>Next</span>
                            <i class="icon-angle-right"></i>
                        </a>
                    </nav><!-- End .pager-nav -->
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->

            <div class="page-content">
                <div class="container">
                    <div class="product-details-top">
    <div class="row">

        <!-- Product Gallery -->
        <div class="col-md-6">
            <div class="product-gallery product-gallery-vertical">
                <div class="row">
                    <figure class="product-main-image">
                        <img id="product-zoom" 
                             src="{{ asset($product->image ? 'storage/'.$product->image : 'assets/images/default-product.jpg') }}"> 
                      

                      
                    </figure>

                   
                </div>
            </div>
        </div>

        <!-- Product Info -->
        <div class="col-md-6">
            <div class="product-details">
                <h1 class="product-title">{{ $product->name }}</h1>

                <div class="ratings-container">
                    <div class="ratings">
                        <div class="ratings-val" style="width: {{ $product->rating ?? 0 * 20 }}%;"></div>
                    </div>
                    <a class="ratings-text" href="#product-review-link" id="review-link">({{ $product->reviews_count ?? 0 }} Reviews)</a>
                </div>

                <div class="product-price">
                    ${{ $product->sale_price }}
                    @if($product->price > $product->sale_price)
                        <span class="old-price">${{ $product->price }}</span>
                    @endif
                </div>

                <div class="product-content">
                    <p>{{ $product->description }}</p>
                </div>


       

                <!-- Quantity & Add to Cart -->
                <div class="details-filter-row details-row-size">
                    <label for="qty">Qty:</label>
                    <form action="{{ route('cart') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <div class="product-details-quantity mb-2">
                            <input type="number" id="qty" name="quantity" class="form-control" value="1" min="1" max="10" step="1" required>
                        </div>
                        <div class="product-details-action">
                            <button type="submit" class="btn-product btn-cart"><span>add to cart</span></button>
                            <div class="details-action-wrapper">
                                <a href="#" class="btn-product btn-wishlist" title="Wishlist"><span>Add to Wishlist</span></a>
                                <a href="#" class="btn-product btn-compare" title="Compare"><span>Add to Compare</span></a>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Footer: Category & Social -->
                <div class="product-details-footer mt-3">
                    <div class="product-cat">
                        <span>Category:</span>
                        <a href="#">{{ $product->category->name ?? 'No Category' }}</a>
                    </div>
                    <div class="social-icons social-icons-sm mt-2">
                        <span class="social-label">Share:</span>
                        <a href="#" class="social-icon" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                        <a href="#" class="social-icon" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                        <a href="#" class="social-icon" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                        <a href="#" class="social-icon" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

                 
<h3 class="text-center">{{ __('You May Also Like') }}</h3>
 <div class="tab-pane fade show active" id="top-all-tab">
                <div class="row justify-content-center product-card">
                    @foreach($relatedProducts as $product)
                    <div class="col-6 col-md-4 col-lg-3 col-xl-5col ">
                        <div class="product product-11 text-center">
                            <figure class="product-media">
                                <a href="{{ route('product.show', $product->slug) }}">
                                    <!-- Default image if not found -->
                                    <img src="{{ $product->image_url  }}" 
                                        alt="{{ $product->name }}" class="product-image">
                                   
                                 
                                </a>

                                    <div class="product-action-vertical">
                                       <a href="javascript:;" 
                                        data-id="{{ $product->id}}"
                                        class="btn-product-icon btn-wishlist">
                                            <span>Add to Wishlist</span>
                                        </a>
                                    </div>

                            </figure><!-- End .product-media -->

                            <div class="product-body">
                            
                                <h3 class="product-title">
                                    <a href="{{ route('product.show', $product->slug) }}">{{ $product->name }}</a>
                                </h3><!-- End .product-title -->
                               
                                <div class="product-price">
                                    ${{ $product->sale_price }}
                                  
                                </div><!-- End .product-price -->
                            </div><!-- End .product-body -->

                            {{-- <!-- Add to cart form -->
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
                            </div><!-- End .product-action --> --}}
                            <div class="product-action">
                                <a href="javascript:;" 
                                data-id="{{$product->id}}"
                                class="btn-product btn-cart" >
                                    <span>add to cart</span>
                                </a>
                            </div><!-- End .product-action -->
                        </div><!-- End .product -->
                    </div><!-- End .col -->
                    @endforeach
                </div><!-- End .row -->
            </div><!-- End .tab-pane -->
                    
                </div><!-- End .container -->
            </div><!-- End .page-content -->
        </main><!-- End .main -->


@endsection
