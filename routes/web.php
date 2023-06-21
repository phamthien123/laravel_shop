<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;

//Admin
Route::get('/adminHome', [AdminController::class, 'adminHome']);
Route::get('/view_user', [AdminController::class, 'view_user']);
Route::get('/delete_user/{id}', [AdminController::class, 'delete_user']);
Route::get('/view_category', [AdminController::class, 'view_category']);
Route::post('/add_category', [AdminController::class, 'add_category']);
Route::get('/delete_category/{id}', [AdminController::class, 'delete_category']);
Route::get('/view_product', [AdminController::class, 'view_product']);
Route::post('/add_product', [AdminController::class, 'add_product']);
Route::get('/show_product', [AdminController::class, 'show_product']);
Route::get('/edit_product/{id}', [AdminController::class, 'edit_product']);
Route::post('/update/{id}', [AdminController::class, 'update']);
Route::get('/delete_product/{id}', [AdminController::class, 'delete_product']);

//CartAdmin
Route::get('/show_order', [AdminController::class, 'show_order']);
Route::get('delivery/{id}',[AdminController::class,'delivery']);
Route::get('received/{id}',[AdminController::class,'received']);

//Search
Route::get('searchOrder',[AdminController::class,'searchOrder']);
Route::get('searchProduct',[AdminController::class,'searchProduct']);

//Home
Route::get('/', [HomeController::class, 'redirect']);
Route::get('/index', [ProductController::class, 'homeProduct']);
Route::get('/all_Product', [ProductController::class, 'all_Product']);
Route::get('/allFeature', [ProductController::class, 'allFeature']);
Route::get('/allHot', [ProductController::class, 'allHot']);
Route::get('/product_detail/{id}', [ProductController::class, 'product_detail']);
Route::get('Search_product', [ProductController::class, 'Search_product']);
Route::get('/sort-by',[ProductController::class,'sort_by']);

//CartUser
Route::post('/add_cart/{id}', [CartController::class, 'add_cart']);
Route::get('/showCart', [CartController::class, 'showCart']);
Route::get('/remove_cart/{id}', [CartController::class, 'remove_cart']);
Route::get('/checkout', [CartController::class, 'checkout']);
Route::get('/orderCart', [CartController::class, 'orderCart']);
Route::get('/stripe/{Total}', [CartController::class,'stripe']);
Route::post('stripe/{Total}',[CartController::class,'stripePost'])->name('stripe.post');
Route::get('cancel/{id}',[CartController::class,'cancel']);



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




require __DIR__ . '/auth.php';
