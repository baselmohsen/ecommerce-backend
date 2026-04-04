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
        // Latest products for homepage
        $products = Cache::remember('home_products', 600, function () {
            return Product::with('category')->latest()->take(10)->get();
        });

        // Trending / featured products (for carousel)
        $trendyProducts = Cache::remember('trendy_products', 600, function () {
            return Product::with('category')->where('is_trendy', true)->latest()->take(10)->get();
        });

        // Recent arrivals
        $recentArrivals = Cache::remember('recent_arrivals', 600, function () {
            return Product::with('category')->latest()->take(8)->get();
        });

        // Categories
        $categories = Cache::remember('home_categories', 600, function () {
            return Category::with('products')->latest()->take(5)->get();
        });

        return view('front.home', compact('products', 'trendyProducts', 'recentArrivals', 'categories'));
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
        Cache::forget('trendy_products');
        Cache::forget('recent_arrivals');
    }

    public function about()
    {
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

    public function contact()
    {
        return view('front.contact');
    }
}