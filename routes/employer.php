<?php

use App\Http\Controllers\Employer\AuthController;
use App\Http\Controllers\Employer\JobController;
use App\Http\Controllers\Employer\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


// Route::controller(AuthController::class)->group(function () {
//     Route::prefix('employer')->group(function () {
//         Route::post('register', 'register');
//         Route::post('login', 'login');
//         Route::middleware('auth:api')->group(function () {
//             Route::post('logout', 'logout');
//             Route::post('change-password', 'changePassword');



//             Route::controller(ProfileController::class)->group(function () {
//                 Route::post('profile', 'updateProfile')->name('profile.update');
//                 Route::get('profile-index', 'index')->name('profile.get');
//             });


//             Route::controller(JobController::class)->group(function () {
//                 Route::prefix('job')->group(function () {
//                     Route::post('store', 'store')->name('job.store');
//                     Route::get('index', 'index')->name('job.index');
//                     Route::get('edit/{id}', 'edit')->name('job.edit');
//                     Route::post('update', 'update')->name('job.update');
//                     Route::get('delete/{id}', 'delete')->name('job.delete');
//                 });
//             });
//         });
//     });
// });
