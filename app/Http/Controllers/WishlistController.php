<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie;

class WishlistController extends Controller
{
    // Show wishlist items
    public function index()
    {
        $id = App::make('wishlist.id'); // get wishlist id from cookie
        $wishlistItems = Wishlist::with('product')->where('wishlist_id', $id)
        ->Orwhere('user_id',Auth::id())
        ->get();
           // dd($wishlistItems);
        return view('front.wishlist', compact('wishlistItems'));
    }

    // Add product to wishlist
    public function store(Request $request)
    {
        $product = Product::findOrFail($request->post('product_id'));
        $wishlist_id = App::make('wishlist.id');

        $wishlist = Wishlist::where([
            'wishlist_id' => $wishlist_id,
            'product_id' => $request->post('product_id'),
        ])->first();

        if (!$wishlist) {
            Wishlist::create([
                'wishlist_id' => $wishlist_id,
                'product_id' => $request->post('product_id'),
                'user_id' => Auth::id(),
            ]);
        }
                return response()->json([
                    'status' => 'success',
                    'message' => "Product {$product->name}  added successfully to wishlist"
                ]);
        // return redirect()->back()->with('success', "Product {$product->name} added successfully to wishlist");
    }

    // Remove item from wishlist
    public function remove($id)
    {
        Wishlist::findOrFail($id)->delete();
            return response()->json([
                    'status' => 'success'
                ]);
    }
}