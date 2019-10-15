<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Appointment;
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
        $myAppointment = Appointment::where('status', 'for inspection')->with('vehicle', 'user', 'clearance')->get();

        return $myAppointment;
    }
    
}
