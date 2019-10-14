<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Vehicle;
use App\Appointment;
use App\ClearanceDescription;
use Illuminate\Support\Str;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreVehicleRequest;
use Auth;
use Carbon;

class VehicleController extends Controller
{
    public function storeClearance(Request $request, $vehicle_id, $user_id)
    {
        $vehicle = Vehicle::find($vehicle_id);

        $clearance = new ClearanceDescription;
        $clearance->user_id = $user_id;
        $clearance->vehicle_id = $vehicle->id;
        $clearance->op_number = $request->op_number;
        $clearance->purpose = $request->purpose;
        $clearance->permit_to_assemble = $request->permit_to_assemble;
        $clearance->record_check = $request->record_check;
        $clearance->status = 'payment on process';
        $clearance->application_status = 'walk_in';
        $clearance->save();

        $date = Carbon\Carbon::now()->toDateString();
        $time = Carbon\Carbon::now()->toTimeString();
        $random = Str::random(10);
        $appointment_code = "$vehicle->id-$vehicle->plate_number-$random-$date-$time";

        $appointment = new Appointment;
        $appointment->user_id = $user_id;
        $appointment->vehicle_id = $vehicle->id;
        $appointment->qr_code = $appointment_code;
        //$appointment->plate_number = $vehicle->plate_number;
        $appointment->save();

        return response()->json([
            'clearance' => $clearance,
            'appointment' => $appointment,
        ]);
    }
    //STEP 2
    public function storeOnline(StoreVehicleRequest $request)
    {   
        $user = User::find(Auth::user()->id);
        $date = Carbon\Carbon::now()->toDateString();
        $time = Carbon\Carbon::now()->toTimeString();
        $random = Str::random(10);
        $code = "$user->first_name-$user->id-$request->plate_number-$random-$date-$time";

        $vehicle = new Vehicle;
        $vehicle->user_id = Auth::user()->id;
        $vehicle->qr_code = $code;
        $vehicle->plate_number = $request->plate_number;
        $vehicle->body_type = $request->body_type;
        $vehicle->make = $request->make;
        $vehicle->series = $request->series;
        $vehicle->year_model = $request->year_model;
        $vehicle->color = $request->color;
        $vehicle->engine_number = $request->engine_number;
        $vehicle->chassis_number = $request->chassis_number;
        $vehicle->me_control_number = $request->me_control_number;
        $vehicle->classification = $request->classification;
        $vehicle->lto_cc_number = $request->lto_cc_number;
        $vehicle->mv_file_number = $request->mv_file_number;
        $vehicle->mvrr_number = $request->mvrr_number;
        $vehicle->cr_number = $request->cr_number;
        $vehicle->application_status = 'online';
        $vehicle->status = 'payment on process';
        $vehicle->save();

        return $vehicle;
    }

    //STEP 1
    public function storeWalkin(StoreVehicleRequest $request, $id)
    {   
        $user = User::find($id);
        $date = Carbon\Carbon::now()->toDateString();
        $time = Carbon\Carbon::now()->toTimeString();
        $random = Str::random(10);
        $code = "$user->first_name-$user->id-$request->plate_number-$random-$date-$time";

        $vehicle = new Vehicle;
        $vehicle->user_id = $user->id;
        $vehicle->qr_code = $code;
        $vehicle->plate_number = $request->plate_number;
        $vehicle->body_type = $request->body_type;
        $vehicle->make = $request->make;
        $vehicle->series = $request->series;
        $vehicle->year_model = $request->year_model;
        $vehicle->color = $request->color;
        $vehicle->engine_number = $request->engine_number;
        $vehicle->chassis_number = $request->chassis_number;
        $vehicle->me_control_number = $request->me_control_number;
        $vehicle->classification = $request->classification;
        $vehicle->lto_cc_number = $request->lto_cc_number;
        $vehicle->mv_file_number = $request->mv_file_number;
        $vehicle->mvrr_number = $request->mvrr_number;
        $vehicle->cr_number = $request->cr_number;
        $vehicle->application_status = 'walk_in';
        $vehicle->status = 'payment on proccess';
        $vehicle->save();

    }

    //STEP 2
    public function paymentDone(Request $request, $clearance_id, $vehicle_id)
    {   
        $clearance = ClearanceDescription::find($clearance_id);
        $clearance->land_bank_sbr_no = $request->land_bank_sbr_no;
        $clearance->status = 'for inspection';
        $clearance->save();

        $vehicle = Vehicle::find($vehicle_id);
        $vehicle->status = 'for inspection';
        $vehicle->save();

    }

    //STEP 3
    public function physicalInspectionCrimeLab(Request $request, $clearance_id, $vehicle_id)
    {   
        //Crime laboratory
        if($request->hasFile('scanned_stencil_chassis')){
            //Get filename with the extension
            $filenameWithExtChassis = $request->file('scanned_stencil_chassis')->getClientOriginalName();
            //Generate Random string
            $randomStringChassis = Str::random(20);
            //Get just filename
            $filenameChassis = pathinfo($filenameWithExtChassis, PATHINFO_FILENAME);
            //Get just ext
            $extensionChassis = $request->file('scanned_stencil_chassis')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStoreChassis = $filenameChassis.'_'.time().'_'.$randomStringChassis.'.'.$extensionChassis; 
            //full_image link
            $filenameURLChassis = 'https://pnp-automation-bucket.s3-ap-southeast-1.amazonaws.com/media/'. $fileNameToStoreChassis;
            //Upload Image to s3
            Storage::disk('s3')->put('media/'.$fileNameToStoreChassis , fopen($request->file('scanned_stencil_chassis'), 'r+'), 'public');

        } else {
            $filenameURLChassis = null;
        }

        if($request->hasFile('scanned_stencil_motor')){
            //Get filename with the extension
            $filenameWithExtEngine = $request->file('scanned_stencil_chassis')->getClientOriginalName();
            //Generate Random string
            $randomStringEngine = Str::random(20);
            //Get just filename
            $filenameEngine = pathinfo($filenameWithExtEngine, PATHINFO_FILENAME);
            //Get just ext
            $extensionEngine = $request->file('scanned_stencil_chassis')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStoreEngine = $filenameEngine.'_'.time().'_'.$randomStringEngine.'.'.$extensionEngine; 
            //full_image link
            $filenameURLEngine = 'https://pnp-automation-bucket.s3-ap-southeast-1.amazonaws.com/media/'. $fileNameToStore;
            //Upload Image to s3
            Storage::disk('s3')->put('media/'.$fileNameToStoreEngine , fopen($request->file('scanned_stencil_chassis'), 'r+'), 'public');

        } else {
            $filenameURLChassis = null;
        }

        $vehicle = Vehicle::find($vehicle_id);
        $vehicle->crime_lab_inspection = 'done';
        $vehicle->scanned_stencil_chassis = $request->scanned_stencil_chassis;
        $vehicle->scanned_stencil_motor = $fileNameToStoreChassis;
        $vehicle->scanned_stencil_chassis_url = $filenameURLChassis;
        $vehicle->scanned_stencil_motor_url = $filenameURLEngine;
        if ($vehicle->hpg_inspection == 'pending') {
            $vehicle->status = 'for inspection';
        } else {
            $vehicle->status = 'for approval';
        }
        $vehicle->save();

        $clearance = ClearanceDescription::find($clearance_id);
        if ($vehicle->crime_lab_inspection == 'pending') {
            $clearance->status = 'for inspection';
        } else {
            $clearance->status = 'for approval';
        }
        $clearance->save();

        return $vehicle;
    }

    //STEP 3
    public function physicalInspectionHPG(Request $request, $clearance_id, $vehicle_id)
    {   

        $vehicle = Vehicle::find($vehicle_id);
        $vehicle->hpg_inspection = 'done';
        if ($vehicle->crime_lab_inspection == 'pending') {
            $vehicle->status = 'for inspection';
        } else {
            $vehicle->status = 'for approval';
        }
        $vehicle->save();

        $clearance = ClearanceDescription::find($clearance_id);
        if ($vehicle->crime_lab_inspection == 'pending') {
            $clearance->status = 'for inspection';
        } else {
            $clearance->status = 'for approval';
        }
        $clearance->save();

        return $vehicle;
    }

    //STEP 4
    public function finalProccess(Request $request, $clearance_id, $vehicle_id)
    {
        $clearance = ClearanceDescription::find($clearance_id);
        $clearance->land_bank_sbr_no = $request->land_bank_sbr_no;
        $clearance->status = 'done';
        $clearance->save();

        $vehicle = Vehicle::find($vehicle_id);
        $vehicle->status = $request->status;
        $vehicle->findings = $request->findings;
        $vehicle->save();

        return $vehicle;
    }

}
