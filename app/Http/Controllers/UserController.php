<?php

namespace App\Http\Controllers;



use App\Payment;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;

use App\ShippingDetail;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index(){
        return view('admin');
    }

    public function postshipping(Request $request){
        try {
//            $data = $request->validate([
//                'receiver_name' => ['required', 'string', 'max:255'],
//                'phone_number' => ['required', 'numeric', 'unique:users'],
//                'location' => ['required', 'string'],
//                'ETA' => ['required', 'string'],
//                'note' => ['string'],
//                'longitude' => ['string'],
//                'latitude' => ['string'],
//            ]);

//            if ($data->fails()) {
//                $response = ['message' => $data->errors()->all()];
//                return response($response, 422);
//            }

            $sender = Auth::user();
            $sender = User::where('id', $sender->id)->first();
            $receiver = User::where('phone_number', $request->receivernumber)->first();

            if(!$receiver){
                $receiver = new User();
                $receiver->phone_number = $request->receivernumber;
                $receiver->username = $request->receiver_name;
                $receiver->save();
            }
            $objShippingData = new ShippingDetail();
            $objShippingData->sender_id = $sender->id;
            $objShippingData->receiver_id = $receiver->id;
            $objShippingData->receiver_name = $request->receivername;
            $objShippingData->phone_number = $request->receivernumber;
            $objShippingData->location = $request->receiverlocation;
            $objShippingData->note = $request->note;
            $objShippingData->ETA = $request->eta;
            $objShippingData->tracking_id = 'track-'.time();
            $objShippingData->longitude = $request->longitude;
            $objShippingData->latitude = $request->latitude;
            $objShippingData->status = 0;
            $objShippingData->save();

            $response = ['shippingData' => $objShippingData, 'message' => 'You have been successfully created shipping!'];
            return response($response, 200);

        } catch (\Exception $objException) {
            $response = ['message' => $objException->getMessage()];
            return response($response, 422);
        }

    }

    public  function getshippinglist(){

        try {
        $user = Auth::user();
        $user = User::where('id', $user->id)->first();
            $objShippingData = ShippingDetail::where('sender_id', $user->id)->get();
            $response = ['shippingData' => $objShippingData, 'message' => 'You have been successfully created shipping!'];
            return response($response, 200);

        } catch (\Exception $objException) {
            $response = ['message' => $objException->getMessage()];
            return response($response, 422);
        }
    }

    public  function savePayments(Request $request){

        try {
        $user = Auth::user();
            $user = User::where('id', $user->id)->first();
            $objPayment = new Payment();
            $objPayment->user_id = $user->id;
            $objPayment->card_no = $request->card_no;
            $objPayment->expiry_month =  $request->expiry_month;
            $objPayment->expiry_year = $request->expiry_year;
            $objPayment->save();

            $response = ['card_details'=>$objPayment, 'message' => 'You have been successfully created shipping!'];
            return response($response, 200);

        } catch (\Exception $objException) {
            $response = ['message' => $objException->getMessage()];
            return response($response, 422);
        }
    }

    public  function searchByTracking(Request  $request){
        try {
        $user = Auth::user();
            $user = User::where('id', $user->id)->first();
            if($user){
            $objShippingData = ShippingDetail::where('tracking_id', $request->tracking_id)->where('receiver_id', $user->id)->first();
            $objShippingData = ShippingDetail::where('tracking_id', 'track-1624161999')->where('receiver_id', 41)->first();
            $response = ['shippingData' => $objShippingData, 'message' => 'You have been successfully created shipping!'];
            return response($response, 200);
            }else{
                $response = ['message' => "Wrong data entered"];
                return response($response, 422);
            }

        } catch (\Exception $objException) {
            $response = ['message' => $objException->getMessage()];
            return response($response, 422);
        }
    }

    public  function updateShippingStatus(Request  $request){
        try {
        $user = Auth::user();
            $user = ShippingDetail::where('phone_number', $request->phone_number)->where('tracking_id',$request->tracking_code)->first();
            $user->status=1;
            $user->save();
            $response = ['message' => 'You have been successfully created shipping!'];
            return response($response, 200);

        } catch (\Exception $objException) {
            $response = ['message' => $objException->getMessage()];
            return response($response, 422);
        }
    }

}


