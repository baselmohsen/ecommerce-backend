<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController as FrontProductController ;
use App\Http\Controllers\ProfileController;
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



    
Route::get('/', function () {
    return view('welcome');
});
     Route::get('cart', [CartController::class,'index']);
     Route::post('cart', [CartController::class,'store'])->name('cart');
     Route::get('product/{slug}', [FrontProductController::class,'show'])->name('product.show');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::get('/home', function () {
    return view('home');
})->name('home')->middleware('auth');

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard')->middleware('auth', 'admin');

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function() {

    // Route::post('user', [UserController::class,'store'])->name('users.store');
    // Route::get('user', [UserController::class,'create'])->name('users.create');

    
    Route::get('dashboard', [DashboardController::class,'index'])->name('dashboard');
    
    Route::resource('users', UserController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
});

});
