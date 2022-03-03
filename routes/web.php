<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/',  [App\Http\Controllers\Frontend\FrontendController::class, 'index']);
Route::get('/category',  [App\Http\Controllers\Frontend\FrontendController::class, 'category']);
Route::get('view-category/{slug}',  [App\Http\Controllers\Frontend\FrontendController::class, 'viewcategory']);
Route::get('category/{cate_slug}/{prod_slug}',  [App\Http\Controllers\Frontend\FrontendController::class, 'productview']);

Route::get('/product-list',  [App\Http\Controllers\Frontend\FrontendController::class, 'productListAjax']);
Route::post('search-product',  [App\Http\Controllers\Frontend\FrontendController::class, 'searchProduct']);
Auth::routes();

Route::get('load-cart-data', [App\Http\Controllers\Frontend\CartController::class, 'cartCount']);
Route::get('load-wishlist-data', [App\Http\Controllers\Frontend\WishlistController::class, 'wishlistCount']);
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('add-to-cart',  [App\Http\Controllers\Frontend\CartController::class, 'addProduct']);
Route::post('/delete-cart-item', [App\Http\Controllers\Frontend\CartController::class, 'deleteProduct']);
Route::post('update-cart', [App\Http\Controllers\Frontend\CartController::class, 'updateCart']);


Route::post('add-to-wishlist',  [App\Http\Controllers\Frontend\WishlistController::class, 'add']);
Route::post('/delete-wishlist-item', [App\Http\Controllers\Frontend\WishlistController::class, 'delete']);


Route::middleware(['auth'])->group(function () {
    Route::get('cart',  [App\Http\Controllers\Frontend\CartController::class, 'viewCart']);


    Route::get('checkout',  [App\Http\Controllers\Frontend\CheckoutController::class, 'index']);
    Route::post('/proceed-to-pay', [App\Http\Controllers\Frontend\CheckoutController::class, 'razorpayCheck']);
    Route::post('/place-order',  [App\Http\Controllers\Frontend\CheckoutController::class, 'placeOrder']);

    Route::get('my-orders', [App\Http\Controllers\Frontend\UserController::class, 'index']);
    Route::get('view-order/{id}', [App\Http\Controllers\Frontend\UserController::class, 'view']);

    Route::post('/add-rating', [App\Http\Controllers\Frontend\RatingController::class, 'add']);

    Route::get('add-review/{product_slug}/user-review', [App\Http\Controllers\Frontend\ReviewController::class, 'add']);
    Route::post('add-review', [App\Http\Controllers\Frontend\ReviewController::class, 'create']);
    Route::get('edit-review/{product_slug}/user-review', [App\Http\Controllers\Frontend\ReviewController::class, 'edit']);
    Route::put('update-review', [App\Http\Controllers\Frontend\ReviewController::class, 'update']);

    Route::get('wishlist',  [App\Http\Controllers\Frontend\WishlistController::class, 'index']);
});

Route::middleware(['auth', 'isAdmin'])->group(function () {
    //Dashboard
    Route::get('/dashboard',  [App\Http\Controllers\Admin\FrontendController::class, 'index']);

    //Category
    Route::get('/categories', [App\Http\Controllers\Admin\CategoryController::class, 'index']);

    Route::get('/add-category', [App\Http\Controllers\Admin\CategoryController::class, 'add']);
    Route::post('/insert-category', [App\Http\Controllers\Admin\CategoryController::class, 'insert']);

    Route::get('/edit-prod/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'edit']);
    Route::put('/update-prod/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'update']);

    Route::get('/delete-prod/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'destroy']);


    //Product
    Route::get('/products', [App\Http\Controllers\Admin\ProductController::class, 'index']);
    Route::get('/add-product', [App\Http\Controllers\Admin\ProductController::class, 'add']);
    Route::post('/insert-product', [App\Http\Controllers\Admin\ProductController::class, 'insert']);

    Route::get('/edit-product/{id}', [App\Http\Controllers\Admin\ProductController::class, 'edit']);
    Route::put('/update-product/{id}', [App\Http\Controllers\Admin\ProductController::class, 'update']);

    Route::get('/delete-product/{id}', [App\Http\Controllers\Admin\ProductController::class, 'destroy']);


    Route::get('orders', [App\Http\Controllers\Admin\OrderController::class, 'index']);
    Route::get('admin/view-order/{id}', [App\Http\Controllers\Admin\OrderController::class, 'view']);
    Route::post('update-order/{id}', [App\Http\Controllers\Admin\OrderController::class, 'updateOrder']);
    Route::get('order-history', [App\Http\Controllers\Admin\OrderController::class, 'orderHistory']);

    Route::get('users', [App\Http\Controllers\Admin\DashboardController::class, 'users']);
    Route::get('view-user/{id}', [App\Http\Controllers\Admin\DashboardController::class, 'view']);
});
