<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Carbon;
use App\Http\Requests\RegisterAccountRequest;

class AccountController extends Controller
{
    public function store(RegisterAccountRequest $request)
    {


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

        $date = Carbon\Carbon::now()->toDateString();
        $time = Carbon\Carbon::now()->toTimeString();
        $random = Str::random(10);
        $code = "$user->id-$random-$date-$time";

        $update = User::find($user->id);
        $update->qr_code = $code;
        $update->save();
        
        return $update;
    }
}
