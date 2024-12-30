<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\PageController;
use Illuminate\Support\Facades\Auth;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// USER ROUTE
Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/home', [HomeController::class, 'home'])->name('home');
Route::get('/product', [HomeController::class, 'product'])->name('product');
Route::get('/article', [HomeController::class, 'article'])->name('article');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/detail-article/{id}', [HomeController::class, 'detailArticle'])->name('detail-article');
Route::get('/detail-product/{id}', [HomeController::class, 'detailProduct'])->name('detail-product');

Route::get('/admin/product', [ProductController::class, 'product'])->name('admin.product');
Route::get('/admin/transaction', [PageController::class, 'transaction'])->name('admin.transaction');

Route::get('/hiking-trails', [HomeController::class, 'hikingTrails'])->name('hiking-trails');
Auth::routes();



// USER ROUTE WITH AUTHENTICATION
Route::group(['middleware' => ['auth']], function () {
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist');
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/wishlist/add', [WishlistController::class, 'addToWishlist'])->name('wishlist.add');
    Route::post('/wishlist/remove', [WishlistController::class, 'remove'])->name('wishlist.remove');
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/checkout/single', [TransactionController::class, 'checkoutSingle'])->name('checkout.single');
    Route::post('/checkout', [TransactionController::class, 'checkoutArray'])->name('checkout.array');
});

// ADMIN ROUTE
Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('/admin/dashboard', [PageController::class, 'dashboard'])->name('admin.dashboard');

    // Product Master
    Route::get('/admin/product', [ProductController::class, 'index'])->name('admin.product');
    Route::get('/admin/product/datatables', [ProductController::class, 'datatables'])->name('admin.product.datatables');
    Route::match(['post', 'patch', 'delete'], '/product-crud', [ProductController::class, 'crud'])->name('admin.product.crud');

    // Article Master
    Route::get('/admin/article', [ArticleController::class, 'index'])->name('admin.article');
    Route::get('/admin/article/datatables', [ArticleController::class, 'datatables'])->name('admin.article.datatables');
    Route::match(['post', 'patch', 'delete'], '/article-crud', [ArticleController::class, 'crud'])->name('admin.article.crud');
});
