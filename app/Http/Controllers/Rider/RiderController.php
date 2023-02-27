<?php

namespace App\Http\Controllers\Rider;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Keke;
use App\Models\TripHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiderController extends Controller
{
    public function RiderDashboard()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        $kekeData = Keke::firstWhere('rider_id', $id);
        $tripHistory = TripHistory::where('rider_id', $id)->where('status', 1)->first();
        return view('rider.index', compact('profileData','kekeData','tripHistory'));

    }

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'Logout Successful',
            'alert-type' => 'success'
        );

        return redirect('/login')->with($notification);
    }

    public function changeStatus(Request $request)
    {
        // dd($request);
        $user = User::find($request->user_id);
        $user->status = $request->status;
        $user->save();
        return response()->json(['success'=>'Status Updated Successfully.']);
    }

    
}