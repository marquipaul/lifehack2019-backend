<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Carbon;

class AccountController extends Controller
{
    public function store(Request $request)
    {
        $date = Carbon\Carbon::now()->toDateString();
        $time = Carbon\Carbon::now()->toTimeString();
        $random = Str::random(10);
        $code = "$request->first_name-$request->tin_number-$random-$date-$time";

        $user = new User();
        $user->qr_code = $code;
        $user->email = $request->email;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->middle_name = $request->middle_name;
        $user->gender = $request->gender;
        $user->user_type = 'applicant';
        $user->mobile_number = $request->mobile_number;
        $user->birthday = $request->birthday;
        $user->classification = $request->classification;
        $user->avatar = $request->avatar;
        $user->address = $request->address;
        $user->tin_number = $request->tin_number;
        $user->password = Hash::make($request->password);
        $user->save();

        return $user;
    }
}
