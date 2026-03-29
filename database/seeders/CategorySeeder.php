<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // MAIN CATEGORIES WITH IMAGES
        $baby = Category::create([
            'name' => 'Baby Care',
            'description' => 'Products for babies and infants',
            'image' => 'assets/images/default-category.jpg',
        ]);

        $face = Category::create([
            'name' => 'Face Care',
            'description' => 'Skin care products for the face',
                        'image' => 'assets/images/default-category.jpg',

        ]);

        $hair = Category::create([
            'name' => 'Hair Care',
            'description' => 'Hair treatment and styling products',
                        'image' => 'assets/images/default-category.jpg',

        ]);

        $body = Category::create([
            'name' => 'Body Care',
            'description' => 'Body lotions and hygiene products',
                        'image' => 'assets/images/default-category.jpg',

        ]);

        $vitamins = Category::create([
            'name' => 'Vitamins & Supplements',
            'description' => 'Health supplements and vitamins',
                       'image' => 'assets/images/default-category.jpg',

        ]);

        // OTHER CATEGORIES WITH IMAGES (to make total 10)
        $oral = Category::create([
            'name' => 'Oral Care',
            'description' => 'Toothpaste, toothbrushes, and mouthwash',
                        'image' => 'assets/images/default-category.jpg',

        ]);

        $firstAid = Category::create([
            'name' => 'First Aid',
            'description' => 'Bandages, antiseptics, and medical kits',
            'image' => 'assets/images/default-category.jpg',
        ]);

        $personalHygiene = Category::create([
            'name' => 'Personal Hygiene',
            'description' => 'Soaps, deodorants, and feminine care',
            'image' => 'assets/images/default-category.jpg',
        ]);

        $skinTreatments = Category::create([
            'name' => 'Skin Treatments',
            'description' => 'Creams and ointments for skin problems',
            'image' => 'assets/images/default-category.jpg',
        ]);

        $medicalDevices = Category::create([
            'name' => 'Medical Devices',
            'description' => 'Thermometers, blood pressure monitors, etc.',
            'image' => 'assets/images/default-category.jpg',
        ]);
    }
}