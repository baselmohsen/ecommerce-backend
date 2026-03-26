<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{

         public function index()
            {
                $products = Product::with('category')->latest()->take(8)->get();
                $categories = Category::with('products')->latest()->take(4)->get();

               
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

}
