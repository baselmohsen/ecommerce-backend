<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{


    public function show($slug)
    {
        // Get the current product with its category
        $product = Product::with('category')->where('slug', $slug)->firstOrFail();

        // Get related products from the same category, excluding current product
        $relatedProducts = Product::where('category_id', $product->category_id)
                                ->where('id', '!=', $product->id)
                                ->inRandomOrder()
                                ->take(4)
                                ->get();

        // Pass both to the view
        return view('front.products.show', [
            'product' => $product,
            'relatedProducts' => $relatedProducts,
        ]);
    }


    public function categoryPproducts($id){

            $category = Category::findOrFail($id);
            $products = $category->products()->paginate(9);
            //dd($products);
            return view('front.categoryProducts', compact('products','category'));

    }
}
