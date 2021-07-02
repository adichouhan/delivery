<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Exception;
use Twilio\Rest\Client;

class ApiAuthController extends Controller
{


    protected function register(Request $request)
    {
        try {
            $data = $request->validate([
                'username' => ['required', 'string', 'max:255'],
                'phone_number' => ['required', 'numeric', 'unique:users'],
                'location' => ['required', 'string'],
                'avatar' => ['string'],
                'avatar_name' => ['string'],
                'email' => ['email', 'string'],
            ]);

            DB::connection()->enableQueryLog();
            $user = User::where('phone_number', request('phone_number'))->whereNull('otp_verified')->first();
            if(!$user) {
                $user = new User();
                $user->username = request('username');
                $user->phone_number = request('phone_number');
                $user->password = Hash::make(request('password'));
                $user->location = request('location');
                $user->email = request('email');
//               $user->avatar   =   request('avatar');
                $user->avatar_name = request('avatar_name');
                $user->save();

//                if (request('avatar')) {
//                    $folderPath = "images/";
//                    $img = request('avatar');
//
//                    $image_parts = explode(";base64,", $img);
////                    return $image_parts[1];
//                    $image_type_aux = explode("image/", $image_parts[0]);
//                    $pos  = strpos($img, ';');
//                    return $pos;
//                    $image_type = explode(':', substr($img, 0, $pos))[1];;
//                    $image_base64 = base64_decode($image_parts[1]);
//                    $file = $folderPath . uniqid() . '. ' . $image_type;
//
//                    file_put_contents($file, $image_base64);
//                }
            }
            $queries = DB::getQueryLog();

            if($user){
                /* Get credentials from .env */
                $token = getenv("TWILIO_AUTH_TOKEN");
                $twilio_sid = getenv("TWILIO_SID");
                $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
                $twilio = new Client($twilio_sid, $token);
                $twilio->verify->v2->services($twilio_verify_sid)
                    ->verifications
                    ->create($data['phone_number'], "sms");
                $response = ['user' => $user, 'message' => 'You have been successfully logged in!'];
                return response($response, 200);
            }
            $response = ['message' => 'Something went Wrong'];
            return response($response, 422);
        }catch (Exception $e){
            $response = ['message' => $e->getMessage()];
            return response($response, 422);
        }
    }

    public function login(Request  $request){
        $user = User::where('phone_number', $request->phone_number)->first();
        if ($user) {
            $token = getenv("TWILIO_AUTH_TOKEN");
            $twilio_sid = getenv("TWILIO_SID");
            $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
            $twilio = new Client($twilio_sid, $token);
            $twilio->verify->v2->services($twilio_verify_sid)
                ->verifications
                ->create($request->phone_number, "sms");
            $response = ['user'=> $user, ];
            return response($response, 200);
        }

        $response = ['message' => 'Something Went wrong!'];
        return response($response, 422);
    }

    public function getShippingUsers(Request  $request){
        $user = User::where('phone_number', $request->phone_number)->first();
        if ($user) {
            $response = ['user'=> $user, ];
            return response($response, 200);
        }

        $response = ['message' => 'Something Went wrong!'];
        return response($response, 422);
    }

    protected function verify(Request $request)
    {
        $data = $request->validate([
            'verification_code' => ['required', 'numeric'],
            'phone_number' => ['required', 'string'],
        ]);
        /* Get credentials from .env */
//        $token = getenv("TWILIO_AUTH_TOKEN");
//        $twilio_sid = getenv("TWILIO_SID");
//        $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
//        $twilio = new Client($twilio_sid, $token);
//        $verification = $twilio->verify->v2->services($twilio_verify_sid)
//            ->verificationChecks
//            ->create($data['verification_code'], array('to' => $data['phone_number']));

        if (true) {
//            $user = User::where('phone_number', $request->phone_number)->first();
            $user = User::where('phone_number', '+918805987378')->first();
            if ($user) {
                    $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                    if(!$user->notification_token) {
                        $user->notification_token = $request->fcmToken;
                        $user->save();
                    }

//                    }

                    $response = ['token' => $token, 'user'=> $user];
                    return response($response, 200);

            } else {
                $response = ["message" => 'User does not exist'];
                return response($response, 422);
            }
        }else{
            $response = ['message' => 'Verification  Invalid'];
            return response($response, 422);
        }
    }

        public function logout (Request $request) {
            $token = $request->user()->token();
            $token->revoke();
            $response = ['message' => 'You have been successfully logged out!'];
            return response($response, 200);
        }



}
