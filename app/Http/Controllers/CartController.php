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

    public function index(){
        $id=App::make('cart.id');
        $cartItems=Cart::with('product')->where('cart_id',$id)->get();
        $total=$cartItems->sum(function($item){
            return $item->product->sale_price * $item->quantity;
        });
        
        return view('front.cart',compact('cartItems','total'));
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
                        'user_id '=> Auth::id(),
                        ]);
                    }
                            return response()->json([
                                'status' => 'success',
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
                Cart::findOrFail($id)->delete();
                return response()->json([
                        'status' => 'success'
                    ]);
        }
        }
   

