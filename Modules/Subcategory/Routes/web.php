<?php

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

use Modules\Categories\Entities\Category;

Route::group(['middleware' => ['role:admin']], function () {

    Route::resource('subcategories', SubcategoryController::class);

    Route::get('/get-subcategories/{category}', function (Category $category) {

        return response()->json([
            'subcategories' => $category->subcategories
        ]);
    });
});
