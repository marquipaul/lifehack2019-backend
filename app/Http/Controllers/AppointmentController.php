<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Appointment;
use App\Vehicle;
use Auth;

class AppointmentController extends Controller
{
    public function getAppointments()
    {
        $myAppointment = Appointment::where('processed_by', Auth::user()->id)->with('vehicle', 'user', 'clearance')->get();

        return $myAppointment;
    }

    public function getForInspection()
    {
        $myAppointment = Vehicle::where('status', 'for inspection')->with('user')->get();

        return $myAppointment;
    }
    
}
