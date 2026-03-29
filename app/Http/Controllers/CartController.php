<?php

namespace App\Http\Controllers;
use Yoeunes\Toastr\Facades\Toastr;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function index(Request $request){
        $id=App::make('cart.id');
        $cartItems=Cart::with('product')->where('cart_id',$id)
        ->orWhere('user_id',Auth::id())
        ->get();
        $total=$cartItems->sum(function($item){
            return $item->product->sale_price * $item->quantity;
        });
        
        
        if ($request->ajax()) {
            $cartHtml = view('components.cart-dropdown', compact('cartItems', 'total'))->render();
            return response()->json([
                'status' => 'success',
                'cartHtml' => $cartHtml,
                'cartCount' => $cartItems->count(),
                'total' => $total
            ]);
        }

    // Regular page request
       return view('front.cart', compact('cartItems', 'total'));
    }

    public function store(Request $request){
            //dd($request->all());
            $product = Product::findOrFail($request->post('product_id'));
            $cart_id=App::make('cart.id');
                $cart=Cart::where([
                    'cart_id'=>$cart_id,
                    'product_id'=>$request->post('product_id'),
                ])->first();
                if($cart){
                    $cart->increment('quantity', $request->post('quantity', 1));
                }else{

                    Cart::create([
                        'cart_id' => $cart_id,
                        'quantity'=>$request->post('quantity',1),
                        'product_id'=>$request->post('product_id'),
                        'user_id'=> Auth::id(),
                        ]);
                    }
                            return response()->json([
                                'status' => 'success',
                                'user_id' => Auth::id(),
                                'message' => "Product {$product->name}  added successfully  to cart!"
                            ]); 
                  }
          public function update(Request $request, $id)
        {
            $cart = Cart::findOrFail($id);

            $cart->update([
                'quantity' => $request->quantity
            ]);

            $itemTotal = $cart->quantity * ($cart->product->sale_price ?? $cart->product->price);

            return response()->json([
                'message' => "Product {$cart->product->name}  quantity updated successfully",
                'item_total' => $itemTotal,
            ]);
        }
  

       public function remove($id)
{
    // Delete the item
    Cart::findOrFail($id)->delete();

    // Get updated cart items
    $cartId = App::make('cart.id');
    $cartItems = Cart::with('product')
        ->where('cart_id', $cartId)
        ->orWhere('user_id', auth()->id())
        ->get();

    $total = $cartItems->sum(function($item){
        return $item->product->sale_price * $item->quantity;
    });

    // Render updated cart component
    $cartHtml = view('components.cart-dropdown', compact('cartItems', 'total'))->render();

    return response()->json([
        'status' => 'success',
        'message' => 'Item removed!',
        'cartHtml' => $cartHtml,
        'cartCount' => $cartItems->count(),
        'total' => $total
    ]);
}
        }
   

