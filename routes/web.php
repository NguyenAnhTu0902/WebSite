<?php

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

# Admin cms
Route::prefix('admin')->middleware('CheckAdminLogin')->group(function() {
    Route::redirect('','admin/users');
    Route::resource('users',\App\Http\Controllers\Cms\UserController::class);
    Route::resource('categories',\App\Http\Controllers\Cms\CategoryController::class);
    Route::resource('brands',\App\Http\Controllers\Cms\BrandController::class);
    Route::resource('products',\App\Http\Controllers\Cms\ProductController::class);
    Route::resource('products/{id}/images', \App\Http\Controllers\Cms\ProductImageController::class);
    Route::resource('products/{id}/details', \App\Http\Controllers\Cms\ProductDetailController::class);
    Route::resource('orders',\App\Http\Controllers\Cms\OrderController::class);
    Route::prefix('login')->group(function () {
        Route::get('',[\App\Http\Controllers\Cms\HomepageController::class, 'getLogin'])->withoutMiddleware('CheckAdminLogin');
        Route::post('',[\App\Http\Controllers\Cms\HomepageController::class, 'postLogin'])->withoutMiddleware('CheckAdminLogin');
    });
    Route::get('logout', [\App\Http\Controllers\Cms\HomepageController::class, 'logout']);

});

//#Homepage
Route::get('/', [App\Http\Controllers\Client\HomepageController::class, 'index']);

//# Shop
Route::prefix('shop')->group(function (){
    Route::get('', [App\Http\Controllers\Client\ProductController::class, 'index']);
    Route::get('/product/{id}', [App\Http\Controllers\Client\ProductController::class, 'show']);
    Route::post('/product/{id}', [App\Http\Controllers\Client\ProductController::class, 'postComment']);
    Route::get('/category/{categoryName}', [App\Http\Controllers\Client\ProductController::class, 'category']);
});

Route::prefix('cart')->group(function (){
    Route::get('',[App\Http\Controllers\Client\CartController::class, 'index']);
    Route::get('add',[App\Http\Controllers\Client\CartController::class, 'add']);
    Route::get('/delete',[App\Http\Controllers\Client\CartController::class, 'delete']);
    Route::get('/update',[App\Http\Controllers\Client\CartController::class, 'update']);
});

Route::prefix('order')->group(function (){
    Route::get('',[App\Http\Controllers\Client\OrderController::class, 'index']);
    Route::post('/',[App\Http\Controllers\Client\OrderController::class, 'addOrder']);
    Route::get('/result',[App\Http\Controllers\Client\OrderController::class, 'result']);
    Route::get('/vnPayCheck',[App\Http\Controllers\Client\OrderController::class, 'vnPayCheck']);
});

Route::prefix('account')->group(function (){
    Route::get('/login',[App\Http\Controllers\Client\AccountController::class, 'login']);
    Route::post('/login',[App\Http\Controllers\Client\AccountController::class, 'checkLogin']);
    Route::get('/actived/{id}/{token}',[App\Http\Controllers\Client\AccountController::class, 'actived']);
    Route::get('/logout',[App\Http\Controllers\Client\AccountController::class, 'logout']);
    Route::get('/register',[App\Http\Controllers\Client\AccountController::class, 'register']);
    Route::post('/register',[App\Http\Controllers\Client\AccountController::class, 'postRegister']);
});

Route::prefix('my-order')->middleware('CheckUserLogin')->group(function (){
    Route::get('/',[App\Http\Controllers\Client\AccountController::class, 'myOrder']);
    Route::get('/{id}',[App\Http\Controllers\Client\AccountController::class, 'myOrderDetail']);
});


