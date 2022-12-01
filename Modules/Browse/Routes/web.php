<?php

use Illuminate\Support\Facades\Route;
use Modules\Browse\Services\BrowseService;
use Modules\Browse\Http\Controllers\BrowseProductController;
use Modules\Browse\Http\Controllers\BrowseBusinessController;

// Route::group(['middleware' => ['role:admin']], function () {

//     Route::resource('browse', BrowseBusinessController::class);
// });

Route::prefix('browse')->group(function () {

    Route::get('/', [BrowseBusinessController::class, 'index']);
    Route::get('/business', [BrowseBusinessController::class, 'index']);
    Route::get('/products', [BrowseProductController::class, 'index']);
});

// View item
Route::get('/business/{id}/{slug}', [BrowseBusinessController::class, 'viewBusiness']);

Route::get('/product/{id}/{slug}', [BrowseProductController::class, 'viewProduct']);
