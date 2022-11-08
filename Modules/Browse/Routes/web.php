<?php

use Modules\Browse\Services\BrowseService;
use Modules\Browse\Http\Controllers\BrowseController;

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
// Route::group(['middleware' => ['role:admin']], function () {

//     Route::resource('browse', BrowseController::class);
// });

Route::get('browse', [BrowseController::class, 'index']);
Route::get('browse/business', [BrowseController::class, 'index']);

Route::get('search-business-name/{business_name?}', function ($business_name = '') {

    return BrowseService::searchBusinessName($business_name);
});

Route::get('search-address/{address?}', function ($address = '') {

    return BrowseService::searchAddress($address);
});
