<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'cors'], function () {

    //Categories
    $this->resource('categories', 'Admin\CategoryController');

    //Products
    $this->resource('/product', 'Admin\ProductController');
    $this->get('/product/{parent_category}/{limit}/{offset}', 'Admin\ProductController@index');

    //location
    $this->get('/location', 'Admin\ProductController@location');
    $this->get('/location/group', 'Admin\ProductController@groupbyLocation');
    $this->get('/location/search', 'Admin\ProductController@searchLocation');
    $this->get('/products/search', 'Admin\ProductController@searchName');
});
