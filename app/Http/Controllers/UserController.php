<?php

namespace App\Http\Controllers;



use Validator;

use App\ShippingDetail;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index(){
        return view('admin');
    }

    public function postInsertShippingData(Request $request){

        try {
            $validator = Validator::make($request->all(), [
                'receiver_name'=>'required',
                'location'=>'required',
                'eta'=>'required',
                'mobile_number'=>'required|numeric',
                'longitude'=>'required|numeric',
                'latitude'=>'required|numeric'
            ]);

            if ($validator->fails()) {
                return response()->json(['status' => 400, 'error' => $validator->errors()->all()]);
            }
            $objShippingData = new ShippingDetail();
            $objShippingData->receiver_name = $request->receiver_name;
            $objShippingData->mobile_number = $request->mobile_number;
            $objShippingData->location = $request->location;
            $objShippingData->note = $request->note;
            $objShippingData->ETA = $request->eta;
            $objShippingData->longitude = $request->longitude;
            $objShippingData->latitude = $request->latitude;
            $objShippingData->save();
            return response()->json(['status' => 200, 'message' => 'success']);

        } catch (\Exception $objException) {
            $arrMixResponse['status'] = 500;
            $arrMixResponse['error'] = $objException->getMessage();
            return response()->json($arrMixResponse);
        }


    }

}


