<?php

use Illuminate\Support\Facades\Route;
use Modules\Businesses\Http\Controllers\BusinessesController;

// use Modules\Browse\Http\Controllers\BrowseController;
// use Modules\Businesses\Http\Controllers\BusinessesController;

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
Route::group(['middleware' => ['role:admin']], function () {

    Route::resource('businesses', BusinessesController::class);
});

// Public
Route::get('/business/{id}/{slug?}', [BusinessesController::class, 'viewBusiness']);
