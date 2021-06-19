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
            if(!$user){
               $user = new User();
               $user->username =   request('username');
               $user->phone_number =   request('phone_number');
               $user->password =   Hash::make(request('password'));
               $user->location =   request('location');
               $user->email    =   request('email');
               $user->avatar   =   request('avatar');
               $user->avatar_name  =   request('avatar_name');
               $user->save();
            }
            $queries = DB::getQueryLog();

            if($user){
                /* Get credentials from .env */
//                $token = getenv("TWILIO_AUTH_TOKEN");
//                $twilio_sid = getenv("TWILIO_SID");
//                $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
//                $twilio = new Client($twilio_sid, $token);
//                $twilio->verify->v2->services($twilio_verify_sid)
//                    ->verifications
//                    ->create($data['phone_number'], "sms");
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

    public function signIn(Request  $request){
        $intMobnumber = $request->number;
        $user = User::where('phone_number', $request->phone_number)->first();
        if ($user) {
            $token = $user->createToken('Laravel Password Grant Client')->accessToken;
            $response = ['token' => $token, 'user'=> $user];
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
        $user = User::where('phone_number', $request->phone_number)->first();
        $token = $user->createToken('Laravel Password Grant Client')->accessToken;
        $response = ['token' => $token, 'user'=> $user];
        return response($response, 200);
        /* Get credentials from .env */
        $token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_sid = getenv("TWILIO_SID");
        $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
        $twilio = new Client($twilio_sid, $token);
        $verification = $twilio->verify->v2->services($twilio_verify_sid)
            ->verificationChecks
            ->create($data['verification_code'], array('to' => $data['phone_number']));
        if ($verification->valid) {
            $user = User::where('phone_number', $request->phone_number)->first();
            if ($user) {
                    $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                    $response = ['token' => $token, 'user'=> $user];
                    return response($response, 200);

            } else {
                $response = ["message" => 'User does not exist'];
                return response($response, 422);
            }
        }
    }


        public function logout (Request $request) {
            $token = $request->user()->token();
            $token->revoke();
            $response = ['message' => 'You have been successfully logged out!'];
            return response($response, 200);
        }



}
