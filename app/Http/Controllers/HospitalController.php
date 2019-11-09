<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hospital;
use App\BloodRequest;
use App\Http\Requests\HospitalRequest;

class HospitalController extends Controller
{
    public function index()
    {
        return Hospital::with('transactions')->get();
    }

    public function getHospitalInfo($id)
    {
        return BloodRequest::where('hospital_id', $id)->with('donor', 'requestor', 'hospital')->get();
    }

    public function store(HospitalRequest $request)
    {
        $hospital = new Hospital;
        $hospital->name = $request->name;
        $hospital->address = $request->address;
        $hospital->long = $request->long;
        $hospital->lat = $request->lat;
        $hospital->save();
    
        return Hospital::where('id', $hospital->id)->with('transactions')->first();
    }
}
