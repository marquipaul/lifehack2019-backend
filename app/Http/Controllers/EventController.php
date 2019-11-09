<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\Http\Requests\EventRequest;

class EventController extends Controller
{
    public function store(EventRequest $request)
    {
        $event = new Event;
        $event->title = $request->title;
        $event->address = $request->address;
        $event->start = $request->start;
        $event->long = $request->long;
        $event->lat = $request->lat;
        $event->save();

        return $event;
    }
}
