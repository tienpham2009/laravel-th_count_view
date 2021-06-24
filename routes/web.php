<?php

use App\Http\Controllers\ProductController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('product' , [ProductController::class , 'index'])->name('index');
Route::get('/{id}/product' , [ProductController::class , 'show'])->name('show');
Route::get('{id}/cart' , [ProductController::class , 'cart'])->name('cart');
Route::get('/delete-cart' , [ProductController::class , 'destroyCart'])->name('destroyCart');
Route::get('/update-cart' , [ProductController::class , 'updateCart'])->name('update-cart');
Route::get('cart' , [ProductController::class , 'showCart'])->name('show-cart');
