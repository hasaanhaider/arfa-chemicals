<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FactoryController;
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

Route::get('/', function () {
    return view('welcome');
})->name('index');


Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'indexView');
    Route::post('/login-post', 'login')->name('login-post');
});

Route::controller(FactoryController::class)->group(function () {
    Route::group(['middleware' => 'auth'], function () {
        Route::get('index', 'index')->name('factory.index');
        Route::get('create', 'create')->name('factory.create');
        Route::post('store', 'store')->name('factory.store');
        Route::delete('destroy/{id}', 'destroy')->name('factory.destroy');
    });
});
