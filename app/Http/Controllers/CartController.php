<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class CartController extends Controller
{

    public function index(){
        $id=$this->getCartId();
        $cartItems=Cart::with('product')->where('cart_id',$id)->get();
        return view('front.cart',compact('cartItems'));
    }

    public function store(Request $request){
            //dd($request->all());
            $product = Product::findOrFail($request->post('product_id'));

                $cart=Cart::where([
                    'cart_id'=>$this->getCartId(),
                    'product_id'=>$request->post('product_id'),
                ])->first();
                if($cart){
                   $cart->increment('quantity',$request->post('quantity'));
                }else{

                    Cart::create([
                        'cart_id' => $this->getCartId(),
                        'quantity'=>$request->post('quantity'),
                        'product_id'=>$request->post('product_id'),
                        'user_id '=> Auth::id(),
                        ]);
                    }

            return redirect()->back()->with('success',"product {$product->name} added successfully to cart");
    }


    public function getCartId(){
        $id=Cookie::get('cart_id');
        if(!$id){
                $id=Str::uuid();
                Cookie::queue('cart_id',$id,60*24*30);
        }
        return $id;
    }
}
