<?php

namespace App\Http\Controllers\Passenger;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PassengerController extends Controller
{
    public function PassengerDashboard()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        // $kekeData = Keke::firstWhere('rider_id', $id);
        // $tripHistory = TripHistory::where('rider_id', $id)->where('status', 1)->first();
        return view('passenger.index', compact('profileData'));
    }

    public function destroy()
    {
        Session::flush();
        Auth::logout();

        session()->flash('message', 'Logout Successful');
        return redirect('/');
    }

    
}
 