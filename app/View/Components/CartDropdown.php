<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Cookie;
use App\Models\Cart;

class CartDropdown extends Component
{
    public $cartItems;
    public $total;

    public function __construct()
    {
        $cartId = Cookie::get('cart_id');

        // Fetch cart items and calculate total
        $this->cartItems = $cartId 
            ? Cart::with('product')->where('cart_id', $cartId)->get()
            : collect();

        $this->total = $this->cartItems->sum(function ($item) {
            return $item->quantity * $item->product->sale_price;
        });
    }

    public function render()
    {
        return view('components.cart-dropdown');
    }
}