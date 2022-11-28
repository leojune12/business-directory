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

Route::get('search-business-name/{business_name?}', function ($business_name = '') {

    return BrowseService::searchBusinessName($business_name);
});

Route::get('search-address/{address?}', function ($address = '') {

    return BrowseService::searchAddress($address);
});
