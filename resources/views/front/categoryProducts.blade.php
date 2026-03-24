@extends('layouts.front.app')

@section('content')
   <main class="main">
        <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
            <div class="container">
                <h1 class="page-title">{{ $category->name }}<span>Shop</span></h1>

            </div>
        </div>

        <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Shop</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $category->name ?? 'Category' }}</li>
                </ol>
            </div>
        </nav>

        <div class="page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="toolbox">
                            <div class="toolbox-left">
                               <div class="toolbox-info">
                                        Showing <span>{{ $products->count() }}</span> of <span>{{ $products->total() }}</span> Products
                                    </div>
                            </div>

                            <div class="toolbox-right">
                                <div class="toolbox-sort">
                                    <label for="sortby">Sort by:</label>
                                    <div class="select-custom">
                                        <select name="sortby" id="sortby" class="form-control">
                                            <option value="popularity" selected="selected">Most Popular</option>
                                            <option value="rating">Most Rated</option>
                                            <option value="date">Date</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="toolbox-layout">
                                    <a href="category-list.html" class="btn-layout">
                                        <svg width="16" height="10">
                                            <rect x="0" y="0" width="4" height="4" />
                                            <rect x="6" y="0" width="10" height="4" />
                                            <rect x="0" y="6" width="4" height="4" />
                                            <rect x="6" y="6" width="10" height="4" />
                                        </svg>
                                    </a>
                                    <a href="category-2cols.html" class="btn-layout">
                                        <svg width="10" height="10">
                                            <rect x="0" y="0" width="4" height="4" />
                                            <rect x="6" y="0" width="4" height="4" />
                                            <rect x="0" y="6" width="4" height="4" />
                                            <rect x="6" y="6" width="4" height="4" />
                                        </svg>
                                    </a>
                                    <a href="category.html" class="btn-layout active">
                                        <svg width="16" height="10">
                                            <rect x="0" y="0" width="4" height="4" />
                                            <rect x="6" y="0" width="4" height="4" />
                                            <rect x="12" y="0" width="4" height="4" />
                                            <rect x="0" y="6" width="4" height="4" />
                                            <rect x="6" y="6" width="4" height="4" />
                                            <rect x="12" y="6" width="4" height="4" />
                                        </svg>
                                    </a>
                                    <a href="category-4cols.html" class="btn-layout">
                                        <svg width="22" height="10">
                                            <rect x="0" y="0" width="4" height="4" />
                                            <rect x="6" y="0" width="4" height="4" />
                                            <rect x="12" y="0" width="4" height="4" />
                                            <rect x="18" y="0" width="4" height="4" />
                                            <rect x="0" y="6" width="4" height="4" />
                                            <rect x="6" y="6" width="4" height="4" />
                                            <rect x="12" y="6" width="4" height="4" />
                                            <rect x="18" y="6" width="4" height="4" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="products mb-3">
                            <div class="row justify-content-center">

                                @forelse ($products as $product)
                                    <div class="col-6 col-md-4 col-lg-4">
                                        <div class="product product-7 text-center">
                                            <figure class="product-media">

                                                {{-- Product Label --}}
                                                @if ($product->label)
                                                    <span class="product-label label-{{ strtolower($product->label) }}">
                                                        {{ $product->label }}
                                                    </span>
                                                @endif

                                                <a href="{{ route('product.show', $product->id) }}">
                                                    <img 
                                                        src="{{ asset('storage/' . $product->image) }}" 
                                                        alt="{{ $product->name }}" 
                                                        class="product-image"
                                                    >
                                                </a>

                                                <div class="product-action-vertical">
                                                    <a href="#" class="btn-product-icon btn-wishlist btn-expandable">
                                                        <span>add to wishlist</span>
                                                    </a>
                                                  
                                                </div>

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
                                                </div>

                                            </figure>

                                            <div class="product-body">
                                                <div class="product-cat">
                                                    <a href="#">{{ $product->category->name ?? '' }}</a>
                                                </div>

                                                <h3 class="product-title">
                                                    <a href="{{ route('product.show', $product->id) }}">
                                                        {{ $product->name }}
                                                    </a>
                                                </h3>

                                                <div class="product-price">
                                                    @if ($product->sale_price)
                                                        <span class="new-price">${{ number_format($product->sale_price, 2) }}</span>
                                               {{-- <span class="old-price">${{ number_format($product->price, 2) }}</span> --}}
                                                    @else
                                                        ${{ number_format($product->price, 2) }}
                                                    @endif
                                                </div>

                                               

                                                {{-- Product thumbnail variants --}}
                                                @if ($product->images && $product->images->count() > 0)
                                                    <div class="product-nav product-nav-thumbs">
                                                        @foreach ($product->images as $image)
                                                            <a href="#" class="{{ $loop->first ? 'active' : '' }}">
                                                                <img src="{{ asset('storage/' . $image->path) }}" alt="{{ $product->name }}">
                                                            </a>
                                                        @endforeach
                                                    </div>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12 text-center py-5">
                                        <p>No products found in this category.</p>
                                    </div>
                                @endforelse

                            </div>
                        </div>

                       {{-- Pagination --}}
                        @if ($products->hasPages())
                            <nav aria-label="Page navigation">
                                <ul class="pagination justify-content-center">

                                    {{-- Prev --}}
                                    <li class="page-item {{ $products->onFirstPage() ? 'disabled' : '' }}">
                                        <a class="page-link page-link-prev" href="{{ $products->previousPageUrl() }}" aria-label="Previous">
                                            <span aria-hidden="true"><i class="icon-long-arrow-left"></i></span>Prev
                                        </a>
                                    </li>

                                    {{-- Page Numbers --}}
                                    @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                                        <li class="page-item {{ $products->currentPage() == $page ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endforeach

                                    <li class="page-item-total">of {{ $products->lastPage() }}</li>

                                    {{-- Next --}}
                                    <li class="page-item {{ !$products->hasMorePages() ? 'disabled' : '' }}">
                                        <a class="page-link page-link-next" href="{{ $products->nextPageUrl() }}" aria-label="Next">
                                            Next <span aria-hidden="true"><i class="icon-long-arrow-right"></i></span>
                                        </a>
                                    </li>

                                </ul>
                            </nav>
                        @endif

                    </div><!-- End .col-lg-9 -->

                    <aside class="col-lg-3 order-lg-first">
                        <div class="sidebar sidebar-shop">
                            <div class="widget widget-clean">
                                <label>Filters:</label>
                                <a href="#" class="sidebar-filter-clear">Clean All</a>
                            </div>

                            <div class="widget widget-collapsible">
                                <h3 class="widget-title">
                                    <a data-toggle="collapse" href="#widget-1" role="button" aria-expanded="true" aria-controls="widget-1">
                                        Category
                                    </a>
                                </h3>
                                <div class="collapse show" id="widget-1">
                                    <div class="widget-body">
                                        <div class="filter-items filter-items-count">
                                            <div class="filter-item">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="cat-1">
                                                    <label class="custom-control-label" for="cat-1">Dresses</label>
                                                </div>
                                                <span class="item-count">3</span>
                                            </div>
                                            <div class="filter-item">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="cat-2">
                                                    <label class="custom-control-label" for="cat-2">T-shirts</label>
                                                </div>
                                                <span class="item-count">0</span>
                                            </div>
                                            <div class="filter-item">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="cat-3">
                                                    <label class="custom-control-label" for="cat-3">Bags</label>
                                                </div>
                                                <span class="item-count">4</span>
                                            </div>
                                            <div class="filter-item">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="cat-4">
                                                    <label class="custom-control-label" for="cat-4">Jackets</label>
                                                </div>
                                                <span class="item-count">2</span>
                                            </div>
                                            <div class="filter-item">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="cat-5">
                                                    <label class="custom-control-label" for="cat-5">Shoes</label>
                                                </div>
                                                <span class="item-count">2</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="widget widget-collapsible">
                                <h3 class="widget-title">
                                    <a data-toggle="collapse" href="#widget-5" role="button" aria-expanded="true" aria-controls="widget-5">
                                        Price
                                    </a>
                                </h3>
                                <div class="collapse show" id="widget-5">
                                    <div class="widget-body">
                                        <div class="filter-price">
                                            <div class="filter-price-text">
                                                Price Range: <span id="filter-price-range"></span>
                                            </div>
                                            <div id="price-slider"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </aside>

                </div>
            </div>
        </div>
    </main>

@endsection
