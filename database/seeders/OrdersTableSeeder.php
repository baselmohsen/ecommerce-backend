<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderItem;

class OrdersTableSeeder extends Seeder
{
    public function run(): void
    {
        Order::factory(100)->create()->each(function ($order) {
            // Each order has 1-5 items
            OrderItem::factory(rand(1,5))->create([
                'order_id' => $order->id,
            ]);
        });
    }
}