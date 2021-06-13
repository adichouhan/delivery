<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Auth Endpoints
//Route::post('login', 'Auth\ApiAuthController@login');
//
//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::group(['namespace' => '\App\Http\Controllers', 'prefix'=>'admin'], function() {
    Route::group(['namespace' => '\App\Http\Controllers\Admin', 'prefix'=>'delivery'], function() {
        Route::get('/', 'DeliveryController@getDeliveryList');
        Route::post('/add', 'DeliveryController@create');
    });
});