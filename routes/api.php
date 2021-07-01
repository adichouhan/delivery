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
    Route::get('/check',function(){
        $token = env("TWILIO_AUTH_TOKEN");
        $twilio_sid = env("TWILIO_SID");
        $twilio_verify_sid = env("TWILIO_VERIFY_SID");
        dd($token, $twilio_sid, $twilio_verify_sid );
    })->name('payment.api');
    Route::get('/verify/{reference?}','PaymentController@verify')->name('paymentverify.api');

    Route::middleware('auth:api')->get('/user', function (Request $request) {
        return $request->user();
    });

    Route::group(['namespace' => '\App\Http\Controllers\Admin'], function () {
        Route::post('/admin/login', 'AdminAuthController@login')->name('adminlogin.api');
        Route::get('/admin/profiles', 'AdminAuthController@getprofiles')->name('profiles.api');
        Route::get('/admin/profile/{id}', 'AdminAuthController@getprofile')->name('profile.api');
        Route::post('/admin/profile/{id}', 'AdminAuthController@postprofile')->name('profilepost.api');
    });

    Route::group(['middleware' => ['auth:api']], function (){
        Route::post('/logout', 'ApiAuthController@logout')->name('logout.api');
        Route::post('/postshipping', 'UserController@postshipping')->name('postshipping.api');
        Route::get('/searchByTracking', 'UserController@searchByTracking')->name('searchByTracking.api');
        Route::get('/shippinglist', 'UserController@getshippinglist')->name('shippinglist.api');
        Route::get('/getPaymentList', 'UserController@getPaymentList')->name('paymentList.api');
        Route::post('/updateShippingStatus', 'UserController@updateShippingStatus')->name('updateShippingStatus.api');
        Route::post('/saveCards', 'UserController@savePayments')->name('savePayments.api');
        Route::post('/getUsers', 'UserController@getUsers')->name('getusers.api');
        Route::get('/getUser', 'UserController@getUser')->name('getuser.api');
        Route::post('/saveCheckout', 'CheckoutController@saveCheckout')->name('savePayments.api');
    });

});

Route::get('/get', function (){
    return 'daf';
});

Route::group(['namespace' => '\App\Http\Controllers', 'prefix'=>'admin'], function() {
    Route::group(['namespace' => '\App\Http\Controllers\Admin', 'prefix'=>'delivery'], function() {
        Route::get('/', 'DeliveryController@getDeliveryList');
        Route::get('/{id}', 'DeliveryController@getDelivery')->name('delivery.api');
        Route::post('/{id}', 'DeliveryController@postDelivery')->name('delivery.api');
    });

    Route::group(['namespace' => '\App\Http\Controllers\Admin', 'prefix'=>'profile'], function() {
        Route::get('/', 'ProfileController@getProfileList');
        Route::post('/add', 'ProfileController@postProfilecreate');
    });

});

