<?php

namespace App\Http\Controllers;

use App\Checkout;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function saveCheckout(Request  $request)
    {
        $objCheckout= new Checkout();
        $objCheckout->_cvc=$request->_cvc;
        $objCheckout->expiryMonth=$request->expiryMonth;
        $objCheckout->expiryYear=$request->expiryYear;
        $objCheckout->_type=$request->_type;
        $objCheckout->_last4Digits=$request->_last4Digits;
        $objCheckout->reference=$request->reference;
        $objCheckout->status=$request->status;
        $objCheckout->method=$request->payment_method;
        $objCheckout->verify=$request->verify;
        $objCheckout->save();
        $response = ['card_checkout'=> $objCheckout, 'message' => 'You have been successfully created shipping!'];
        return response($response, 200);

    }



}
