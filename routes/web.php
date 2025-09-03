<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TradeController;

use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\AdminBusinessController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminCommentController;
use App\Http\Controllers\Admin\AdminTradeController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ExternalAuthController;

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

/* -- Admin Route -- */

Route::middleware(['auth', 'verified', 'can:access-admin'])->group(function () {
    Route::get('admin',[AdminHomeController::class, 'index'])->name('admin.index');
    Route::get('admin/index',[AdminHomeController::class, 'index'])->name('admin.index');

    Route::get('admin/dashboard',[AdminHomeController::class, 'show'])->name('admin.dashboard');
    Route::get('admin/logout',[AdminHomeController::class, 'destroy'])->name('admin.logout');

    Route::resource('admin/users', AdminUserController::class, [
        'names' => [
            'index'   => 'admin_users.index',
            'create'  => 'admin_users.create',
            'store'   => 'admin_users.store',
            'show'    => 'admin_users.show',
            'edit'    => 'admin_users.edit',
            'update'  => 'admin_users.update',
            'destroy' => 'admin_users.destroy'
        ]
    ]);
    Route::post('admin/avatar', [AdminUserController::class, 'avatar'])->name('admin_users.avatar');
    Route::post('admin/banner', [AdminUserController::class, 'banner'])->name('admin_users.banner');

    Route::resource('admin/business', AdminBusinessController::class, [
        'names' => [
            'index'   => 'admin_business.index',
            'create'  => 'admin_business.create',
            'store'   => 'admin_business.store',
            'show'    => 'admin_business.show',
            'edit'    => 'admin_business.edit',
            'update'  => 'admin_business.update',
            'destroy' => 'admin_business.destroy',
        ]
    ]);

    Route::post('admin/home/delete_file', [AdminHomeController::class, 'delete_file'])->name('admin_home.delete_file');

    Route::resource('admin/products', AdminProductController::class, [
        'names' => [
            'index'   => 'admin_product.index',
            'create'  => 'admin_product.create',
            'store'   => 'admin_product.store',
            'show'    => 'admin_product.show',
            'edit'    => 'admin_product.edit',
            'update'  => 'admin_product.update',
            'destroy' => 'admin_product.destroy'
        ]
    ]);

    Route::resource('admin/trade', AdminTradeController::class, [
        'names' => [
            'index'   => 'admin_trade.index',
            'create'  => 'admin_trade.create',
            'store'   => 'admin_trade.store',
            'show'    => 'admin_trade.show',
            'edit'    => 'admin_trade.edit',
            'update'  => 'admin_trade.update',
            'destroy' => 'admin_trade.destroy',
        ]
    ]);

    Route::resource('admin/comments', AdminCommentController::class, [
        'names' => [
            'index'   => 'admin_comment.index',
            'create'  => 'admin_comment.create',
            'store'   => 'admin_comment.store',
            'show'    => 'admin_comment.show',
            'edit'    => 'admin_comment.edit',
            'update'  => 'admin_comment.update',
            'destroy' => 'admin_comment.destroy'
        ]
    ]);

});

/* -- End Admin Route -- */

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/aboutus', [HomeController::class, 'us'])->name('home.us');

//Terms and conditions
Route::get('/terms-conditions', [HomeController::class, 'ttcc'])->name('home.ttcc');

Route::get('/profile/show/{id}', [ProfileController::class, 'show'])->name('profile.show');

//Business
Route::get('/business', [BusinessController::class, 'index'])->name('business.home');
Route::get('/business/{id}', [BusinessController::class, 'show'])->name('business.show');

//Products
Route::get('/product', [ProductController::class, 'index'])->name('product.home');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

//Trades
Route::get('/trade', [TradeController::class, 'index'])->name('trade.home');
Route::get('/trade/{id}', [TradeController::class, 'show'])->name('trade.show');

//Search
Route::get('/search/results', [SearchController::class, 'show'])->name('search.show');

Route::middleware(['auth', 'verified'])->group(function () {
    //profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.home');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/profile/avatar', [ProfileController::class, 'avatar'])->name('profile.avatar');
    Route::post('/profile/banner', [ProfileController::class, 'banner'])->name('profile.banner');

    Route::post('/profile/save', [ProfileController::class, 'save'])->name('profile.save');
    Route::post('/profile/delete_save', [ProfileController::class, 'delete_save'])->name('profile.delete_save');
    Route::get('/profile/saved', [ProfileController::class, 'saved'])->name('profile.saved');

    //Business crud
    Route::get('/profile/business/index', [BusinessController::class, 'index'])->name('business.index');
    Route::get('/profile/business/create', [BusinessController::class, 'create'])->name('business.create');
    Route::post('/business/store', [BusinessController::class, 'store'])->name('business.store');
    Route::get('/profile/business/edit/{id}', [BusinessController::class, 'edit'])->name('business.edit');
    Route::patch('/business/update/{id}', [BusinessController::class, 'update'])->name('business.update');
    Route::delete('/business/{id}', [BusinessController::class, 'destroy'])->name('business.destroy');

    Route::post('/business/avatar', [BusinessController::class, 'avatar'])->name('business.avatar');
    Route::post('/business/gallery', [BusinessController::class, 'gallery'])->name('business.gallery');
    Route::post('/business/delete_file', [BusinessController::class, 'delete_file'])->name('business.delete_file');

    //product crud
    Route::get('/profile/product/index', [ProductController::class, 'index'])->name('product.index');
    Route::get('/profile/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
    Route::get('/profile/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::patch('/product/update/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::get('/product/delete/{id}', [ProductController::class, 'destroy'])->name('product.destroy');

    Route::post('/product/gallery', [ProductController::class, 'gallery'])->name('product.gallery');
    Route::post('/product/delete_file', [ProductController::class, 'delete_file'])->name('product.delete_file');

    //trade crud
    Route::get('/profile/trade/index', [TradeController::class, 'index'])->name('trade.index');
    Route::get('/profile/trade/create', [TradeController::class, 'create'])->name('trade.create');
    Route::post('/trade/store', [TradeController::class, 'store'])->name('trade.store');
    Route::get('/profile/trade/edit/{id}', [TradeController::class, 'edit'])->name('trade.edit');
    Route::patch('/trade/update/{id}', [TradeController::class, 'update'])->name('trade.update');
    Route::delete('/trade/{id}', [TradeController::class, 'destroy'])->name('trade.destroy');

    Route::post('/trade/avatar', [TradeController::class, 'avatar'])->name('trade.avatar');
    Route::post('/trade/gallery', [TradeController::class, 'gallery'])->name('trade.gallery');
    Route::post('/trade/banner', [TradeController::class, 'banner'])->name('trade.banner');
    Route::post('/trade/delete_file', [TradeController::class, 'delete_file'])->name('trade.delete_file');

});

Route::get('/login-google', [ExternalAuthController::class, 'google_login'])->name('login-google');
Route::get('/google-callback', [ExternalAuthController::class, 'google_callback'])->name('google-callback');

Route::get('/login-facebook', [ExternalAuthController::class, 'facebook_login'])->name('login-facebook');
Route::get('/facebook-callback', [ExternalAuthController::class, 'facebook_callback'])->name('facebook-callback');


require __DIR__.'/auth.php';
