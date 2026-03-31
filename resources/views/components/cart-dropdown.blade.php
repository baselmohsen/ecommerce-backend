<div class="dropdown cart-dropdown">
    <a href="{{ route('cart') }}" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
        
        <div class="icon">
            <i class="icon-shopping-cart"></i>
            <span class="cart-count">{{ $cartItems->count() }}</span>
        </div>
        
        <p>{{ __('Cart') }}</p>
    </a>

    <div class="dropdown-menu dropdown-menu-right">
        <div class="dropdown-cart-products">

            @forelse($cartItems as $item)
                <div class="product div-remove">

                    <div class="product-cart-details">
                        <h4 class="product-title">
                            <a href="{{ route('product.show', $item->product->slug) }}">
                                {{ $item->product->name }}
                            </a>
                        </h4>

                        <span class="cart-product-info">
                            <span class="cart-product-qty">{{ $item->quantity }}</span>
                            x ${{ $item->product->sale_price }}
                        </span>
                    </div>

                    <figure class="product-image-container">
                        <a href="{{ route('product.show', $item->product->slug) }}" class="product-image">
                            <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}">
                        </a>
                    </figure>

                    <a href="javascript:;" 
                       data-id="{{ $item->id }}" 
                       class="btn-remove btn-remove-cart" 
                       title="{{ __('Remove Product') }}">
                        <i class="icon-close"></i>
                    </a>

                </div>
            @empty
                <p class="text-center p-2">{{ __('Cart is empty') }}</p>
            @endforelse

        </div>

        <div class="dropdown-cart-total">
            <span>{{ __('Total') }}</span>
            <span class="cart-total-price">${{ $total }}</span>
        </div>

        <div class="dropdown-cart-action">
            <a href="{{ route('cart') }}" class="btn btn-primary">
                {{ __('View Cart') }}
            </a>

            <a href="{{ route('checkout') }}" class="btn btn-outline-primary-2">
                <span>{{ __('Checkout') }}</span>
                <i class="icon-long-arrow-right"></i>
            </a>
        </div>
    </div>
</div>