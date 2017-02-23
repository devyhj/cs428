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

// Route::get('/', function (Request $request) {
//     return 'hello';
// });



$api = app('Dingo\Api\Routing\Router');

$api->version('v1', [], function($api){
	$api->resource('users', 'App\Http\Controllers\UserController');
	$api->resource('restaurants', 'App\Http\Controllers\RestaurantController');
	$api->resource('menus', 'App\Http\Controllers\MenuController');
	$api->resource('orders', 'App\Http\Controllers\OrderController', ['except' => ['update']]);
	$api->resource('visits', 'App\Http\Controllers\VisitController');
	$api->resource('messages', 'App\Http\Controllers\MessageController', ['except' => ['update']]);
	$api->resource('options', 'App\Http\Controllers\MenuOptionController');
	$api->resource('categories', 'App\Http\Controllers\MenuCategoryController');

	$api->get('restaurants/menus/{restaurandId}', 'App\Http\Controllers\RestaurantController@showWithMenus');
});