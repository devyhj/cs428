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
	$api->get('/', function () {
		return response()->json([
		    'route' => 'index',
		    'message' => 'Hello'
		]);
	});
});