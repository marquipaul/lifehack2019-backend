<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hospital;
use App\Http\Requests\HospitalRequest;

class HospitalController extends Controller
{
    public function index()
    {
        return Hospital::all();
    }

    public function store(HospitalRequest $request)
    {
        $hospital = new Hospital;
        $hospital->name = $request->name;
        $hospital->address = $request->address;
        $hospital->long = $request->long;
        $hospital->lat = $request->lat;
        $hospital->save();
    
        return $hospital;
    }
}
