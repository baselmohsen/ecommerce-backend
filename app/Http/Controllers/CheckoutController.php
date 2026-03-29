<?php

namespace App\Http\Controllers;

use App\Events\OrderPlaced;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Notifications\NewOrderNotification;
class CheckoutController extends Controller
{
    public function index()
    {


           if (!Auth::check()) {
        // Flash message with login link
                return redirect()->back()->with('error', 'You must <a href="'.route('login').'">Login</a> to proceed to checkout.');
            }
        $id = App::make('cart.id');
        $cartItems = Cart::with('product')->where('cart_id', $id)->get();

        return view('front.checkout', [
            'cartItems' => $cartItems,
            'total' => $cartItems->sum(function ($item) {
                return $item->product->sale_price * $item->quantity;
            }),
        ]);
    }

    public function store(Request $request)
    {
        $id = App::make('cart.id');
        $cartItems = Cart::with('product')->where('cart_id', $id)->get();
        $total = $cartItems->sum(function ($item) {
            return $item->product->sale_price * $item->quantity;
        });

        $request->merge([
            'user_id' => Auth::id(),
            'status' => 'new',
            'total' => $total,
        ]);

        $request->validate([
            'first_name' => 'required|string',
            'last_name'  => 'required|string',
            'email'      => 'required|email',
            'phone'      => 'required|string',
            'address'    => 'required|string',
            'city'       => 'required|string',
            'notes'       => 'nullable|string',
        ]);

        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Cart is empty.');
        }

        // Wrap in transaction
        DB::beginTransaction();

        try {
            // Create Order
            $order = Order::create($request->all());

            // Create Order Items
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $item->product->id,
                    'quantity'   => $item->quantity,
                    'price'      => $item->product->sale_price,
                ]);
            }

            DB::commit();
             
            event(new OrderPlaced($order));

            return redirect()->route('checkout.success');
                            
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to place order: ' . $e->getMessage())->withInput();
        }

        }
        public function success(){
            return  view('front.success');
        }
}