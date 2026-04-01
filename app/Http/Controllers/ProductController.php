<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{


    public function show($slug)
    {
        $product = Product::with('category')->where('slug', $slug)->firstOrFail();

        $relatedProducts = Product::with('category') // 🔥 ADD THIS
                ->where('category_id', $product->category_id)
                ->where('id', '!=', $product->id)
                ->inRandomOrder()
                ->take(4)
                ->get();

        
        if (request()->ajax()) {
            return response()->json([
                'product' => $product,
                'relatedProducts' => $relatedProducts
            ]);
        }

        // normal page load
        return view('front.products.show', compact('product', 'relatedProducts'));
    }


    public function categoryPproducts($id){

            $category = Category::findOrFail($id);
            $products = $category->products()->paginate(20);
            //dd($products);
            return view('front.categoryProducts', compact('products','category'));

    }
}
