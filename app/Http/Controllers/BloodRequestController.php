<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BloodRequest;
use App\User;
use App\Friend;
use Auth;
use App\Events\ApprovedRequest;

class BloodRequestController extends Controller
{
    public function index()
    {
        return BloodRequest::with('donor', 'requestor', 'hospital')->get();
    }

    public function getPendingRequests($id)
    {
        return BloodRequest::where('hospital_id', $id)->where('donor_id', null)->with('requestor', 'hospital')->get();
    }

    public function myRequests()
    {
        return BloodRequest::where('user_id', Auth::user()->id)->with('donor')->get();
    }

    public function myDonations()
    {
        return BloodRequest::where('donor_id', Auth::user()->id)->with('donor')->get();
    }

    public function requestBlood(Request $request)
    {
        $bloodRequest = new BloodRequest;
        $bloodRequest->hospital_id = $request->hospital_id;
        $bloodRequest->user_id = Auth::user()->id;
        $bloodRequest->save();

        return $bloodRequest;
    }

    public function approveByDonor(Request $request, $id)
    {
        $bloodRequest = BloodRequest::find($id);
        $bloodRequest->donor_long = $request->donor_long;
        $bloodRequest->donor_lat = $request->donor_lat;
        $bloodRequest->donor_approved = '1';
        $bloodRequest->donor_id = Auth::user()->id;
        $bloodRequest->save();

        if ($bloodRequest->donor_approved == '1'&&$bloodRequest->user_approved == '1') {
            $friend = new Friend();
            $friend->requestor_id = Auth::user()->id;
            $friend->donor_id = $bloodRequest->donor_id;
            $friend->save();

            $result = BloodRequest::where('id', $bloodRequest->id)->with('donor', 'requestor', 'hospital')->first();
            event(new ApprovedRequest($result));
        }

        return $bloodRequest;
    }

    public function approveByRequestor(Request $request, $id)
    {
        $bloodRequest = BloodRequest::find($id);
        $bloodRequest->user_approved = "1";
        $bloodRequest->save();

        if ($bloodRequest->donor_approved == '1'&&$bloodRequest->user_approved == '1') {
            $friend = new Friend();
            $friend->requestor_id = Auth::user()->id;
            $friend->donor_id = $bloodRequest->donor_id;
            $friend->save();

            $result = BloodRequest::where('id', $bloodRequest->id)->with('donor', 'requestor', 'hospital')->first();
            event(new ApprovedRequest($result));
        }

        return $bloodRequest;
    }

    public function finishRequest(Request $request, $id)
    {
        $bloodRequest = BloodRequest::find($id);
        $bloodRequest->status = "1";
        $bloodRequest->points = $request->points;
        $bloodRequest->save();

        $donor = User::find($bloodRequest->donor_id);
        $donor->points = $donor->points+$request->points;
        $donor->save();

        return response()->json([
            "donor" => $donor,
            "request" => $bloodRequest
        ], 200);
    }
}
