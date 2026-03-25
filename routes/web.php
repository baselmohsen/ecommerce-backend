<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\SocialController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController as FrontProductController ;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){ 



    

        Route::get('/', [HomeController::class,'index'])->name('home');
  



     Route::get('profile', [HomeController::class,'profile'])->name('profile')->middleware('auth');

     Route::get('wishlist', [WishlistController::class,'index']);
     Route::post('wishlist', [WishlistController::class,'store'])->name('wishlist');
     Route::delete('/wishlist/remove/{id}', [WishlistController::class, 'remove'])->name('wishlist.remove');


     Route::get('cart', [CartController::class,'index']);
     Route::post('cart', [CartController::class,'store'])->name('cart');
     Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
     Route::put('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');


     Route::get('success', [CheckoutController::class,'success'])->name('checkout.success');
     Route::get('checkout', [CheckoutController::class,'index']);
     Route::post('checkout', [CheckoutController::class,'store'])->name('checkout')->middleware('auth');;

     Route::get('product/{slug}', [FrontProductController::class,'show'])->name('product.show');
     Route::get('category-products/{id}', [FrontProductController::class,'categoryPproducts'])->name('category.products');

    Route::get('/auth/{provider}/redirect', [SocialController::class, 'redirect'])->name('auth.socilaite.redirect');
    Route::get('/auth/{provider}/callback', [SocialController::class, 'callback'])->name('auth.socilaite.callback');

    
// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';


// Route::get('/welcome', function () {
//     return view('welcome');
// })->name('welcome');

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard')->middleware('auth', 'admin');

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function() {

 Route::get('/admin/notifications', [NotificationController::class, 'index'])->name('notifications');
  Route::get('notifications/read/{id}', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    
    Route::get('dashboard', [DashboardController::class,'index'])->name('dashboard');
    
    Route::resource('users', UserController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);



     Route::get('/settings', [SettingController::class, 'index'])
        ->name('settings');

    Route::post('/settings', [SettingController::class, 'update']);

});

});
