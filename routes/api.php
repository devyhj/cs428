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
	$api->get('users/{id}', ['as' => 'users.index', 'uses' => 'App\Http\Controllers\UserController@show']);
	$api->get('restaurants/{id}', ['as' => 'restaurnats.index', 'uses' => 'App\Http\Controllers\RestaurantController@show']);
	$api->get('menus/{id}', ['as' => 'menus.index', 'uses' => 'App\Http\Controllers\MenuController@show']);
	$api->get('orders/{id}', ['as' => 'orders.index', 'uses' => 'App\Http\Controllers\OrderController@show']);
	$api->get('visits/{id}', ['as' => 'visits.index', 'uses' => 'App\Http\Controllers\VisitController@show']);
	$api->get('messages/{id}', ['as' => 'messages.index', 'uses' => 'App\Http\Controllers\MessageController@show']);
});