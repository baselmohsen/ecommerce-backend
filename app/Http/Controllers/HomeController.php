<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
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


        public function profile()
         {
            $user = auth()->user();

            // load orders WITH items + product
                $orders = $user->orders()->with('items')->latest()->get();

                return view('front.profile.index', compact('user', 'orders'));
            }
        public static function flushCache()
        {
            Cache::forget('home_products');
            Cache::forget('home_categories');
        }
}
