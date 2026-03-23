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

                 
                    <h2 class="title text-center mb-4">You May Also Like</h2><!-- End .title text-center -->

                    
                </div><!-- End .container -->
            </div><!-- End .page-content -->
        </main><!-- End .main -->


@endsection
{{-- <x-breadcrumb title="Home" :links="[['name'=>'Home']]" />
<!-- Start Item Details -->
<section class="item-details section">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="container">
        <div class="top-area">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12 col-12">
                    <div class="product-images">
                        <main id="gallery">
                            <div class="main-img">
                                <img src="{{ asset('storage/' . $product->image) }}" id="current" alt="product-image">
                            </div>
                            <div class="images">

                                
                               
                            </div>
                        </main>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-12">
                    <div class="product-info">
                        <h2 class="title">{{$product->name}}</h2>
                        <p class="category"><i class="lni lni-tag"></i> {{$product->category->name}}:<a href="javascript:void(0)">Action
                                cameras</a></p>
                        <h3 class="price">{{$product->sale_price}}<span>{{$product->price}}</span></h3>
                        <p class="info-text">{{$product->description}}</p>
                    <div class="row">

                            <form action="{{route('cart')}}" method="post">
                                @csrf
                                <input type="hidden" name="product_id" value="{{$product->id}}">
                             <div class="col-lg-4 col-md-4 col-12">
                                <div class="form-group quantity">
                                    <label for="color">Quantity</label>
                                    <select class="form-control" name="quantity">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="bottom-content">
                            <div class="row align-items-end">
                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="button cart-button">
                                        <button type="submit" class="btn" style="width: 100%;" >Add to Cart</button>
                                    </div>
                                </div>

                            </form>   
                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="wish-button">
                                        <button class="btn"><i class="lni lni-reload"></i> Compare</button>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="wish-button">
                                        <button class="btn"><i class="lni lni-heart"></i> To Wishlist</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
    </div>
</section>
<!-- End Item Details -->

<!-- Review Modal -->
<div class="modal fade review-modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Leave a Review</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="review-name">Your Name</label>
                            <input class="form-control" type="text" id="review-name" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="review-email">Your Email</label>
                            <input class="form-control" type="email" id="review-email" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="review-subject">Subject</label>
                            <input class="form-control" type="text" id="review-subject" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="review-rating">Rating</label>
                            <select class="form-control" id="review-rating">
                                <option>5 Stars</option>
                                <option>4 Stars</option>
                                <option>3 Stars</option>
                                <option>2 Stars</option>
                                <option>1 Star</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="review-message">Review</label>
                    <textarea class="form-control" id="review-message" rows="8" required></textarea>
                </div>
            </div>
            <div class="modal-footer button">
                <button type="button" class="btn">Submit Review</button>
            </div>
        </div>
    </div>
</div>
<!-- End Review Modal --> --}}
