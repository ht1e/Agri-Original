<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\ProductController;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Client\AccountController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\CheckoutController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Auth\AuthController;
///Admin Controller
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ChartController;

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
Route::get('profile/ordered/{id}', [ClientController::class, 'getOrder'])->name('getOrder');

//403
Route::get('/403', [AuthController::class, 'get403'])->name('403');


Route::prefix('/admin')->middleware('authmiddleware')->group(function() {
    Route::get('/', [AdminController::class, 'index'])->name('admin');

    
//Admin
    Route::get('/category/add', [CategoryController::class, 'index'])->name('category');
    Route::post('/category/add', [CategoryController::class, 'addCategory'])->name('addCategory');

    Route::get('/product', [ProductsController::class, 'index'])->name('adminMainProduct');
    Route::get('/product/add', [ProductsController::class, 'addProduct'])->name('addProduct');
    Route::post('/product/add', [ProductsController::class, 'handleAddProduct'])->name('handleAddProduct');
    Route::get('/product/update/{id}', [ProductsController::class, 'getUpdateProduct'])->name('getUpdateProduct');
    Route::post('/product/update/{id}', [ProductsController::class, 'handleUpdateProduct'])->name('handleUpdateProduct');
    Route::post('/product/delete/{id}', [ProductsController::class, 'handleDeleteProduct'])->name('handleDeleteProduct');

    Route::get('/order', [OrderController::class, 'index'])->name('mainOrder');
    Route::get('/order/ordered', [OrderController::class, 'ordered'])->name('ordered');
    Route::get('/order/acceptOrder', [OrderController::class, 'acceptOrder'])->name('acceptOrder');
    Route::get('/order/rejectOrder', [OrderController::class, 'rejectOrder'])->name('rejectOrder');
    Route::get('/order/successOrder', [OrderController::class, 'successOrder'])->name('successOrder');
    Route::get('/order/orderDetails/{id}', [OrderController::class, 'orderDetails'])->name('orderDetails');
    //accepted order
    Route::post('/acceptedOrder', [OrderController::class, 'acceptedOrder'])->name('acceptedOrder');

    Route::get('/users', [UserController::class, 'index'])->name('mainUsers');
 //   Route::get('/get-last-seven-day', [ChartController::class, 'getLastSevenDay'])->name('getLastSevenDays');
    Route::get('/getDataOfWeek/{date}', [ChartController::class, 'getDataOfWeek'])->name('getDataOfWeek');
    Route::get('/getDataOfYear/{year}', [ChartController::class, 'getDataOfYear'])->name('getDataOfYear');
});




