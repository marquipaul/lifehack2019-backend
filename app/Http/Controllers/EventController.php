<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\Http\Requests\EventRequest;

class EventController extends Controller
{
    public function index()
    {
        return Event::with('users')->get();
    }

    public function store(EventRequest $request)
    {
        $event = new Event;
        $event->title = $request->title;
        $event->address = $request->address;
        $event->start = $request->start;
        $event->long = $request->long;
        $event->lat = $request->lat;
        $event->save();

        return Event::where('id', $event->id)->with('users')->first();
    }

    public function getDonors($id)
    {
        return Event::find($id)->users;
    }

    public function approveDonor(Request $request)
    {
        $event = Event::find($request->event_id);

        $approved = $event->users()->where('user_id', '=', $request->user_id)->first();
        $approved->pivot->approved = '1';
        $approved->pivot->save();

        return response()->json([
            "msg" => 'Approved Successfully'
        ], 200);

        // //notify approved volunteer member
        // $user = User::where('id', '=', $request->user_id)->get();
        // \Notification::send($user,new NotifyVolunteerApproved($event, Auth::user()));

    }
}
