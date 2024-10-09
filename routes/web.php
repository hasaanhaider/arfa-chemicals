<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FactoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
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

Route::get('/dashboard', function () {
    return view('welcome');
})->name('index');


Route::controller(AuthController::class)->group(function () {
    Route::get('/', 'indexView')->name('login');
    Route::post('/login-post', 'login')->name('login-post');
});

Route::controller(FactoryController::class)->group(function () {
    Route::group(['middleware' => 'auth', 'prefix' => 'factories'], function () {
        Route::get('index', 'index')->name('factory.index');
        Route::get('create', 'create')->name('factory.create');
        Route::post('store', 'store')->name('factory.store');
        Route::get('edit/{id}', 'edit')->name('factory.edit');
        Route::put('update/{id}', 'update')->name('factory.update');
        Route::delete('destroy/{id}', 'destroy')->name('factory.destroy');
    });
});


Route::controller(ProductController::class)->group(function () {

    Route::group(['middleware' => 'auth', 'prefix' => 'products'], function () {
        Route::get('index', 'index')->name('product.index');
        Route::get('create', 'create')->name('product.create');
        Route::post('store', 'store')->name('product.store');
        Route::get('edit/{id}', 'edit')->name('product.edit');
        Route::put('update/{id}', 'update')->name('product.update');
        Route::delete('destroy/{id}', 'destroy')->name('product.destroy');
    });
});

Route::controller(OrderController::class)->group(function () {
    Route::group(['middleware' => 'auth', 'prefix' => 'orders'], function () {
        Route::get('index/{id}', 'index')->name('order.index');
        Route::get('create/{id}', 'create')->name('order.create');
        Route::post('store', 'store')->name('order.store');
        Route::get('edit/{id}', 'edit')->name('order.edit');
        Route::put('update/{id}', 'update')->name('order.update');
        Route::delete('destroy/{id}', 'destroy')->name('order.destroy');
    });
});

