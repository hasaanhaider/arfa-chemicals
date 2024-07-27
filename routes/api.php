<?php

use App\Http\Controllers\FrontendController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Route::controller(FrontendController::class)->group(function () {
//     Route::get('job-list', 'index')->name('jobs.index');
//     Route::get('company-list', 'getCompanyList')->name('companies.index');
//     Route::get('job/{id}', 'getSingleJob')->name('jobs.show');
//     Route::post('/search-job', 'SearchJob')->name('search.job');
//     Route::post(['wishlist', 'wishList'])->name('job.wishlist');
// });
