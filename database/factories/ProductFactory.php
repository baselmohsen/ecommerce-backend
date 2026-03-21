<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    public function definition(): array
    {
        $expiry = $this->faker->optional()->dateTimeBetween('now', '+2 years');
        $name = $this->faker->words(3, true);

        return [
            'category_id' => Category::inRandomOrder()->first()?->id ?? Category::factory(),
            'name' => $name,
            'slug' => Str::slug($name), // ✅ correct
            'description' => $this->faker->sentence(4),
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'sale_price' => $this->faker->randomFloat(2, 10, 1000),
            'stock' => $this->faker->numberBetween(0, 100),
            'image' => $this->faker->imageUrl(400, 400, 'technics', true),
            'expiry_date' => $expiry ? $expiry->format('Y-m-d') : null,
        ];
    }
}