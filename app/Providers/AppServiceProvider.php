<?php

namespace App\Providers;
use App\Models\Setting;
use App\Models\Wishlist;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
                Paginator::useBootstrap();

            app()->bind('cart.id',function(){
                $id=Cookie::get('cart_id');
                if(!$id){
                        $id=Str::uuid();
                        Cookie::queue('cart_id',$id,60*24*30);
                }
                return $id;
            });
             app()->bind('wishlist.id', function () {
            $id = Cookie::get('wishlist_id');
            if (!$id) {
                $id = Str::uuid();
                Cookie::queue('wishlist_id', $id, 60 * 24 * 30);
            }
            return $id;
        });

          // Share wishlist count with all views
            View::composer('*', function ($view) {
                $wishlistCount = 0;
                if (Auth::check()) {
                    $wishlistCount = Wishlist::where('user_id', Auth::id())->count();
                } else {
                    $wishlist_id = app()->make('wishlist.id');
                    $wishlistCount = Wishlist::where('wishlist_id', $wishlist_id)->count();
                }
                $view->with('wishlistCount', $wishlistCount);
            });
           View::share('setting', Setting::first()); 
    }
}
