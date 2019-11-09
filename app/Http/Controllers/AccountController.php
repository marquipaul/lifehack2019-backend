<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use GuzzleHttp\Client;
use App\Http\Requests\RegisterAccountRequest;

class AccountController extends Controller
{
    public function accounts()
    {
        return User::with('locations')->get();
    }

    public function store(RegisterAccountRequest $request)
    {

        //Register
        $user = new User();
        $user->qr_code = "";
        $user->email = $request->email;
        $user->name = $request->name;
        $user->blood_type = $request->blood_type;
        $user->gender = $request->gender;
        $user->user_type = 'donor';
        $user->mobile_number = $request->mobile_number;
        $user->birthday = $request->birthday;
        $user->password = Hash::make($request->password);
        $user->save();

        $date = Carbon::now()->toDateString();
        $time = Carbon::now()->toTimeString();
        $random = Str::random(10);
        $code = "$user->id-$random-$date-$time";

        $update = User::find($user->id);
        $update->qr_code = $code;
        $update->save();
        

        //Login
        $http = new Client();
        try {
            $response = $http->post(config('services.passport.login_endpoint'), [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => config('services.passport.client_id'),
                    'client_secret' => config('services.passport.client_secret'),
                    'username' => $request->email,
                    'password' => $request->password,
                    'scope' => '',
                ],
            ]);

            $user = User::where('email', $request->email)->first();
            if (!$user->email_verified_at) {
                $user->email_verified_at = Carbon::now();
                $user->save();
            }
            //return json_decode((string) $response->getBody(), true);

            return response()->json([
                'token' => json_decode((string) $response->getBody(), true),
                'user' => $user,
            ]);

        } catch (\GuzzleHttp\Exception\BadResponseException $e) {
            if ($e->getCode() == 400) {
                return response()->json('Invalid Request. Please enter a username or a password', $e->getCode());
            } else if ($e->getCode() == 401) {
                return response()->json('Your credentials are incorrect. Please try again.', $e->getCode());
                //return response()->json(['error' => 'Your credentials are incorrect. Please try again.'], $e->getCode());
            }
            return response()->json('Something went wrong on the server.', $e->getCode());
        }
    }
}
