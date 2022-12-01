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

Route::get('search-product-name/{product_name?}', function ($product_name = '') {

    return BrowseService::searchProductName($product_name);
});

Route::get('search-address/{address?}', function ($address = '') {

    return BrowseService::searchAddress($address);
});

Route::get('search-subcategories/{category_id}', function ($category_id = '') {

    return BrowseService::searchSubcategories($category_id);
});

Route::get('/business/{id}/{slug?}', [BrowseBusinessController::class, 'viewBusiness']);
