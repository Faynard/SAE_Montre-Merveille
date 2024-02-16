<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
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

Route::get('/contact', function () {
    return view('contact');
})->name('contact.index');

Route::get('/boutiques', function () {
    return view('boutiques');
})->name('boutiques.index');

Route::get('/admin', function () {
    return view('admin');
})->name('admin.index')->middleware('auth', 'authorized');

Route::prefix('user')->name('user.')->controller(UserController::class)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::post('/login', 'doLogin')->name('login');

    Route::get('register', 'register')->name('register');
    Route::post('register', 'doRegister')->name('register');

    Route::post('logout', 'doLogout')->name('logout')->middleware('auth');

    Route::get('profile', 'profile')->name('profile')->middleware('auth');
    Route::put('profile', 'update')->name('profile')->middleware('auth');

    Route::delete('profile', 'delete')->name('profile')->middleware('auth');
});

Route::prefix('product')->name('product.')->controller(ProductController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/{product}', 'show')->name('show');
});

Route::prefix('cart')->name('cart.')->controller(CartController::class)->group(function () {
    Route::post('/add', 'add')->name('add')->middleware("auth");
});
