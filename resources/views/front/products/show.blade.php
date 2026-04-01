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
                             src="{{ $product->image_url }}"> 
                      

                      
                    </figure>

                   
                </div>
            </div>
        </div>

        <!-- Product Info -->
        <div class="col-md-6">
            <div class="product-details">
                <h1 class="product-title">{{ $product->name }}</h1>

           
                <div class="product-content">
                    <p>{{ $product->description }}</p>
                </div>


                <div class="product-price">
                    ${{ $product->sale_price       }}
                    @if($product->price > $product->sale_price)
                        <span class="old-price">   ${{ $product->price }}</span>
                    @endif
                </div>


       

                <!-- Quantity & Add to Cart -->
                <div class="details-filter-row details-row-size">
                
      


                        <div class="product-details-action">
                            <button  data-id="{{$product->id}}" class="btn-product btn-cart"><span>add to cart</span></button>
                            <div class="details-action-wrapper">
                                <a href="javascript:;" class="btn-product btn-wishlist" data-id="{{$product->id}}" title="Wishlist"><span>Add to Wishlist</span></a>
                            </div>
                        </div>
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
                    @foreach($relatedProducts as $related)
                    <div class="col-6 col-md-4 col-lg-3 col-xl-5col ">
                        <div class="product product-11 text-center">
                            <figure class="product-media">
                                <a href="{{ route('product.show', $related->slug) }}">
                                    <!-- Default image if not found -->
                                    <img src="{{ $related->image_url  }}" 
                                        alt="{{ $related->name }}" class="product-image">
                                   
                                 
                                </a>

                                    <div class="product-action-vertical">
                                       <a href="javascript:;" 
                                        data-id="{{ $related->id}}"
                                        class="btn-product-icon btn-wishlist">
                                            <span>Add to Wishlist</span>
                                        </a>
                                    </div>

                            </figure><!-- End .product-media -->

                            <div class="product-body">
                            
                                <h3 class="product-title">
                                    <a href="{{ route('product.show', $related->slug) }}">{{ $related->name }}</a>
                                </h3><!-- End .product-title -->
                               
                                <div class="product-price">
                                    ${{ $related->sale_price }}
                                  
                                </div><!-- End .product-price -->
                            </div><!-- End .product-body -->

            
                            <div class="product-action">
                               <a href="javascript:;" 
                    data-id="{{ $product->id }}"
                    class="btn-product btn-cart {{ $product->stock <= 0 ? 'disable' : '' }}">
                    
                        <span>
                            {{ $product->stock <= 0 ? __('out of stock') : __('add to cart') }}
                        </span>
                        
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
