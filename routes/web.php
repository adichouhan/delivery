<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/otp', function () {
    /* Get credentials from .env */
    $token = getenv("TWILIO_AUTH_TOKEN");
    $twilio_sid = getenv("TWILIO_SID");
    $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
    $twilio = new \Twilio\Rest\Client($twilio_sid, $token);
    $twilio->verify->v2->services($twilio_verify_sid)
        ->verifications
        ->create("+918805987378", "sms");
});

Route::get('/', function () {
   return "Hello";
});
Route::get('/admin', function () {
    return view('admin.admin');
});
Route::get('/delivery', function () {
    return view('admin.admin');
});

Route::get('/profiles', function () {
    return view('admin.admin');
});
Route::get('/token', function () {
    return csrf_token();
});

Route::group([ 'namespace' => '\App\Http\Controllers' ], function() {
    Route::post('/shipping', 'UserController@postInsertShippingData');
});
//Route::get('/shipping', function () {
//
//});
