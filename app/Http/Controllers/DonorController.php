<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use Auth;
use DB;

class DonorController extends Controller
{
    public function join(Request $request)
    {
        //Join Request
        $check = DB::table('event_user')->where('user_id', Auth::user()->id)->where('event_id', $request->event_id)->count();
        if ($check == 0) {
            $event = Event::find($request->event_id);
            $event->users()->attach(Auth::user());
            $msg = 'Joined Successfully';
        } else {
            $msg = 'Joined Already';
        }
            
        return response()->json([
            "msg" => $msg
        ], 200);
    }

    public function leave(Request $request)
    {
        Auth::user()->joinedevents()->detach($request->event_id);

        return response()->json([
            "msg" => 'Leaved Successfully'
        ], 200);
    }
}
