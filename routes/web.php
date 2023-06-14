<?php

use App\Http\Controllers\AdminController;
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

//Home:Chưa Login
Route::get('/', [ProductController::class, 'homeProduct']);
Route::get('/allFeature', [ProductController::class, 'allFeature']);
Route::get('/allHot', [ProductController::class, 'allHot']);
Route::get('/product_detail/{id}', [ProductController::class, 'product_detail']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Home:Khi Login
Route::get('/redirect', [HomeController::class, 'redirect']);


require __DIR__ . '/auth.php';
