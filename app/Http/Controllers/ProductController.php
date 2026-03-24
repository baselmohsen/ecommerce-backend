<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{


    public function show($slug){
        return view('front.products.show',[
            'product'=>Product::with('category')->where('slug',$slug)->firstOrFail(),
        ]);
    }


    public function categoryPproducts($id){

            $category = Category::findOrFail($id);
            $products = $category->products()->paginate(9);
            //dd($products);
            return view('front.categoryProducts', compact('products','category'));

    }
}
