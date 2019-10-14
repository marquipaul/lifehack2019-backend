<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Vehicle;
use App\Appointment;
use App\ClearanceDescription;
use App\Events\ScanApplicationEvent;
use Auth;

class MobileController extends Controller
{
    public function index()
    {
        $search = Input::get('search');

        $vehicles = Vehicle::with('user');
            if ($search != '') {
                $vehicles->orWhere('plate_number', 'like', '%' . $search . '%');
            }

        return $vehicles->get();
        
    }

    public function scanVehicle($code)
    {
        $vehicle = Vehicle::where('qr_code', $code)->with('user')->first();

        return $vehicle;
    }

    public function scanOnlineApplication($code)
    {
       $update = Appointment::where('qr_code', $code)->first();       
       $update->processed_by = Auth::user()->id;
       $update->scanned_at = Carbon\Carbon::now();
       $update->save();

        $appointment = Appointment::where('qr_code', $code)->with('vehicle', 'user', 'clearance')->first();

        event(new ScanApplicationEvent($appointment));

        return $appointment;
    }
}
