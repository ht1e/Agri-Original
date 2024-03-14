<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\ProductController;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Client\AccountController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\CheckoutController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\AdminController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/products', [ProductController::class, 'index'])->name('mainProduct');
Route::get('/products/productDetails/{id}', [ProductController::class, 'getProductDetails'])->name('productDetails');
Route::get('products/category/{id}', [ProductController::class, 'getCategory'])->name('getCategory');
Route::post('/products/filter', [ProductController::class, 'filterProduct'])->name('filterProduct');

//search
Route::post('/search', [ProductController::class, 'getSearch'])->name('search');

//loggin
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'postLogin'])->name('postLogin');

//logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//register
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'postRegister'])->name('postRegister');

//cart
Route::get('/cart', [CartController::class, 'getCart'])->name('getCart');

//API update cart
Route::post('/update-cart', [CartController::class, 'updateCart'])->name('updateCart');

//API add to cart
Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('addToCart');

//get Checkout
Route::post('/checkout', [CheckoutController::class, 'postCheckout'])->name('postCheckout');
Route::get('/checkout', [CheckoutController::class, 'getCheckout'])->name('getCheckout');

//profile
Route::get('/profile', [ClientController::class, 'getProfile'])->name('getProfile');

//403
Route::get('/403', [AuthController::class, 'get403'])->name('403');


Route::prefix('admin')->middleware('authmiddleware')->group(function() {
    Route::get('/', [AdminController::class, 'index'])->name('admin');
});




