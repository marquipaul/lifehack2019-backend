<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Appointment;

class AppointmentController extends Controller
{
    public function getAppointments()
    {
        $myAppointment = Appointment::where('processed_by', Auth::user()->id)
                            ->where('scanned_at', '!=', null)->get();

        return $myAppointment;
    }
    
}
