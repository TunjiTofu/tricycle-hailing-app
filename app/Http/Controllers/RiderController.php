<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiderController extends Controller
{
    public function RiderDashboard()
    {
        return view('rider.dashboard');

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
}
