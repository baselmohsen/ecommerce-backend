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

   

}
