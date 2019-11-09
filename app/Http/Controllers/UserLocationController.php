<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\UserLocation;

class UserLocationController extends Controller
{
    public function store(Request $request)
    {
        $location = new UserLocation;
        $location->user_id = Auth::user()->id;
        $location->long = $request->long;
        $location->lat = $request->lat;
        $location->save();

        return $location;
    }
}
