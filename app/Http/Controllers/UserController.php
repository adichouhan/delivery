<?php

namespace App\Http\Controllers;



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
            $objShippingData->longitude = $request->longitude;
            $objShippingData->latitude = $request->latitude;
            $objShippingData->status = 0;
            $objShippingData->save();
            return response()->json(['status' => 200, 'message' => 'success']);

        } catch (\Exception $objException) {
            $arrMixResponse['status'] = 422;
            $arrMixResponse['error'] = $objException->getMessage();
            return response()->json($arrMixResponse);
        }


    }

}


