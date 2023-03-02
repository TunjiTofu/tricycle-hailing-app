<?php

namespace App\Http\Controllers\Passenger;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\TripHistory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use TarfinLabs\LaravelSpatial\Types\Point;

class BookController extends Controller
{
    public function index()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        $tripHistory = TripHistory::query()
            ->selectDistanceTo('current_location', new Point(lat: 25.45634, lng: 35.54331))
            ->where('status', 1)
            ->get();

        //     $loc = TripHistory::query()
        //    ->selectDistanceTo('current_location', new Point(lat: 25.45634, lng: 35.54331))
        //    ->where('status', 1)
        //    ->get();

        return view('passenger.book.index', compact('tripHistory', 'profileData'));
    }

    public function selectRide(request $request)
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        $keke_id = $request->keke_id;
        $request->validate([
            'keke_id' => 'required|string|max:9|regex:/Keke-\d\d\d\d/',
        ]);
        $numberOfBookings = Book::where('keke_id', $keke_id,)->get();
        $count = count($numberOfBookings);
        // dd($count);
        return view('passenger.book.details', compact('numberOfBookings', 'count','keke_id','profileData'));
    }

    public function storeBookDetailsSession(Request $request)
    {
        // dd($request);
        if($request->session()->get('book_details')){
            $request->session()->forget('book_details');
        }
        $storeDetails = Session::put('book_details', [
            'user_id' => $request->get('user_id'), 
            'pickup_lat' => $request->get('pickup_lat'), 
            'pickup_lng' => $request->get('pickup_lng'), 
            'destination_lat' => $request->get('destination_lat'), 
            'destination_lng' => $request->get('destination_lng'), 
        ]);

        // dd(Session::get('book_details')['pickup_lng']);
        // dd($request->session()->get('book_details'));

        if (!$storeDetails) {
            return response()->json(['error' => 'Booking Details Not Stored']);
        }
        return response()->json(['success' => 'Booking Details Stored']);
    }
}
