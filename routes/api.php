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


Route::group(['middleware' => ['cors', 'json.response']], function () {
    // public routes
    Route::post('/login', 'ApiAuthController@login')->name('login.api');
    Route::post('/verify-phone', 'ApiAuthController@verify')->name('verify.api');
    Route::post('/register','ApiAuthController@register')->name('register.api');
//    Route::post('/makepayment','PaymentController@makePayment')->name('payment.api');
    Route::get('/new-access-code','PaymentController@makePayment')->name('payment.api');
    Route::get('/verify/{reference?}','PaymentController@verify')->name('paymentverify.api');

    Route::middleware('auth:api')->get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/postshipping', 'UserController@postshipping')->name('postshipping.api');
    Route::group(['middleware' => ['auth:api']], function (){
        Route::post('/logout', 'ApiAuthController@logout')->name('logout.api');
    });

});

Route::get('/get', function (){
    return 'daf';
});

Route::group(['namespace' => '\App\Http\Controllers', 'prefix'=>'admin'], function() {
    Route::group(['namespace' => '\App\Http\Controllers\Admin', 'prefix'=>'delivery'], function() {
        Route::get('/', 'DeliveryController@getDeliveryList');
        Route::post('/add', 'DeliveryController@create');
    });
    Route::group(['namespace' => '\App\Http\Controllers\Admin', 'prefix'=>'profile'], function() {
        Route::get('/', 'ProfileController@getProfileList');
        Route::post('/add', 'ProfileController@postProfilecreate');
    });
});

