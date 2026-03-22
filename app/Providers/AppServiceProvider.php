<?php

namespace App\Providers;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
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
                  
    }
}
