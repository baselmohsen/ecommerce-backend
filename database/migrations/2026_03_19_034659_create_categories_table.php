<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // MAIN CATEGORIES
        $baby = Category::create([
            'name' => 'Baby Care',
            'description' => 'Products for babies and infants',
        ]);

        $face = Category::create([
            'name' => 'Face Care',
            'description' => 'Skin care products for the face',
        ]);

        $hair = Category::create([
            'name' => 'Hair Care',
            'description' => 'Hair treatment and styling products',
        ]);

        $body = Category::create([
            'name' => 'Body Care',
            'description' => 'Body lotions and hygiene products',
        ]);

        $vitamins = Category::create([
            'name' => 'Vitamins & Supplements',
            'description' => 'Health supplements and vitamins',
        ]);

        // SUBCATEGORIES

        // Baby Care
        Category::create(['name' => 'Diapers', 'parent_id' => $baby->id]);
        Category::create(['name' => 'Baby Milk', 'parent_id' => $baby->id]);
        Category::create(['name' => 'Baby Shampoo', 'parent_id' => $baby->id]);

        // Face Care
        Category::create(['name' => 'Face Wash', 'parent_id' => $face->id]);
        Category::create(['name' => 'Moisturizers', 'parent_id' => $face->id]);
        Category::create(['name' => 'Sunscreen', 'parent_id' => $face->id]);

        // Hair Care
        Category::create(['name' => 'Shampoo', 'parent_id' => $hair->id]);
        Category::create(['name' => 'Conditioner', 'parent_id' => $hair->id]);
        Category::create(['name' => 'Hair Oil', 'parent_id' => $hair->id]);

        // Body Care
        Category::create(['name' => 'Body Lotion', 'parent_id' => $body->id]);
        Category::create(['name' => 'Shower Gel', 'parent_id' => $body->id]);

        // Vitamins
        Category::create(['name' => 'Vitamin C', 'parent_id' => $vitamins->id]);
        Category::create(['name' => 'Multivitamins', 'parent_id' => $vitamins->id]);
    }
}