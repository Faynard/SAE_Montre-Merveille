<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
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

Route::get('/', [App\Http\Controllers\AcceuilController::class, 'index'])->name('acceuil.index');

Route::prefix('user')->name('user.')->controller(UserController::class)->group(function () {
	Route::get('/login', 'login')->name('login');
    Route::post('/login', 'doLogin')->name('login');

    Route::get('register', 'register')->name('register');
    Route::post('register', 'doRegister')->name('register');

    Route::post('logout', 'doLogout')->name('logout')->middleware('auth');
});

Route::prefix('product')->name('product.')->controller(ProductController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/{product}', 'show')->name('show');
    // Route::post('/{product}/add-to-cart', 'addToCart')->name('add-to-cart')->middleware('auth');
});
