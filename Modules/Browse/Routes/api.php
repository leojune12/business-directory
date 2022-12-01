<?php

use Illuminate\Http\Request;
use Modules\Browse\Services\BrowseService;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/browse', function (Request $request) {
//     return $request->user();
// });

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
