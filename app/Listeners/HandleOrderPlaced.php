<?php

namespace App\Listeners;

use App\Models\Cart;
use App\Models\User;
use App\Notifications\NewOrderNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\App;

class HandleOrderPlaced implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
      public function handle($event)
    {
        $order = $event->order;

        // ✅ 1. Decrease product quantity
        foreach ($order->items as $item) {
            $product = $item->product;
            $product->decrement('stock', $item->quantity);
        }

        // ✅ 2. Clear Cart
        Cart::where('user_id', $order->user_id)
        ->Orwhere('cart_id',App::make('cart.id'))
        ->delete();

        // ✅ 3. Notify Admin
        $super_admin = User::where('type', 'super_admin')->first();
        if ($super_admin) {
            $super_admin->notify(new NewOrderNotification($order));
        }
    }
}
