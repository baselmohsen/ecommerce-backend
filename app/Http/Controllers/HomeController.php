<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{

        public function index()
        {
            // Cache products for 10 minutes (600 seconds)
            $products = Cache::remember('home_products', 600 , function () {
                return Product::with('category')->latest()->take(10)->get();
            });

            // Cache categories for 10 minutes (600 seconds)
            $categories = Cache::remember('home_categories', 600, function () {
                return Category::with('products')->latest()->take(5)->get();
            });

            return view('front.home', compact('products', 'categories'));
        }

            public function SearchAjax(Request $request)
            {
                $search = $request->search;

                $products = Product::with('category')
                    ->where('name', 'like', "%$search%")
                    ->take(10)
                    ->get();

                return response()->json($products);
            }


     
        public static function flushCache()
        {
            Cache::forget('home_products');
            Cache::forget('home_categories');
        }


      public function about() {
    $team_members = [
        [
            'name' => 'Samanta Grey',
            'role' => 'Founder & CEO',
            'bio' => 'لوريم إيبسوم هو نص تجريبي.',
            'image' => 'assets/images/team/member-1.jpg',
            'social' => [
                'Facebook' => '#',
                'Twitter' => '#',
                'Instagram' => '#',
            ],
        ],
        [
            'name' => 'Bruce Sutton',
            'role' => 'Sales & Marketing Manager',
            'bio' => 'لوريم إيبسوم هو نص تجريبي.',
            'image' => 'assets/images/team/member-2.jpg',
            'social' => [
                'Facebook' => '#',
                'Twitter' => '#',
                'Instagram' => '#',
            ],
        ],
    ];

    return view('front.about', compact('team_members'));
}
        public function contact(){
            return view('front.contact');
        }

}
