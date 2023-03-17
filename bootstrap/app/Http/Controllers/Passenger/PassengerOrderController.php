<?php

namespace App\Http\Controllers\Passenger;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\TripHistory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PassengerOrderController extends Controller
{
    public function viewAllOrders()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        $allOrders = Book::where('user_id', $id)->orderBy('created_at', 'desc')->get();
        return view('passenger.order.index', compact('allOrders', 'profileData'));
    }

    public function viewRiderLocation($keke)
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        $riderCurrentLocation = TripHistory::where('keke_id', $keke)->where('status', 1)->first();
        // dd($riderCurrentLocation);
        return view('passenger.order.rider-location', compact('riderCurrentLocation', 'profileData'));
    }
}
