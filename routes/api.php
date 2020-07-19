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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => 'cors'], function () {

    //Categories
    $this->resource('/categories', 'Admin\CategoryController');
    //Categories
    $this->get('/category/search', 'Admin\CategoryController@search');

    //Products
    $this->resource('/product', 'Admin\ProductController');
    $this->get('/product/{parent_category}/{limit}/{offset}', 'Admin\ProductController@index');

    //location
    $this->get('/location', 'Admin\ProductController@location');
    $this->get('/location/group', 'Admin\ProductController@groupbyLocation');
    $this->get('/location/search', 'Admin\ProductController@searchLocation');
    $this->get('/products/search', 'Admin\ProductController@searchName');

    //get city
    $this->get('/city', 'Admin\CityController@index');
    $this->get('/city/{id}', 'Admin\CityController@show');
    //API Post
    $this->resource('post', 'PostController');
    $this->get('post_tag','PostController@get_tag');
    $this->get('post_search','PostController@get_search');
    $this->get('post_recently','PostController@get_recently');
    $this->get('post_favourite','PostController@get_favourite');
    //API Comment
    $this->resource('comment', 'CommentController');
    $this->resource('user', 'UserController');

    //Auth
    $this->post('auth/register', 'UserController@register');
    $this->post('auth/login', 'UserController@login');


    // get all tags
    $this->get('get-all-tag', 'PostController@getAllTag');

    $this->group(['middleware' => 'jwt.auth'], function () {
    $this->get('user-info', 'UserController@getUserInfo');

    });
});