<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Order;
use App\Models\Product;

class OrderItemFactory extends Factory
{
    protected $model = \App\Models\OrderItem::class;

    public function definition(): array
    {
        $product_id = Product::inRandomOrder()->first()->id ?? 1;
        $quantity = $this->faker->numberBetween(1,5);
        $price = $this->faker->randomFloat(2, 20, 200);

        return [
            'order_id' => Order::factory(),
            'product_id' => $product_id,
            'quantity' => $quantity,
            'price' => $price,
        ];
    }
}