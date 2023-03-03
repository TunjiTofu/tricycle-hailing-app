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
use Webpatser\Uuid\Uuid;

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
        $kekeSpace = 3;
        $spaceAvailable = 0;
        $numberOfPassengers = 0;
        $id = Auth::user()->id;
        $profileData = User::find($id);
        $keke_id = $request->keke_id;
        $request->validate([
            'keke_id' => 'required|string|max:9|regex:/Keke-\d\d\d\d/',
        ]);
        $numberOfBookings = Book::where('keke_id', $keke_id,)->where('status', 1)->get();
        $count = count($numberOfBookings);
        // dd($count);
        if ($count > 0) {
            foreach ($numberOfBookings as $bookings) {
                // dd($bookings->number_passengers);
                $numberOfPassengers += $bookings->number_passengers;
            }
            $spaceAvailable = $kekeSpace - $numberOfPassengers;
            // dd($spaceAvailable);
        } else {
            $spaceAvailable = $kekeSpace;
        }
        // dd($spaceAvailable);
        if ($spaceAvailable == 0) {
            $notification = array(
                'message' => 'This Keke is full. Kindly order for another Keke closest to you. Thanks.',
                'alert-type' => 'info'
            );
            return redirect()->back()->with($notification);
        }
        return view('passenger.book.details', compact('numberOfBookings', 'spaceAvailable', 'keke_id', 'profileData'));
    }

    public function storeBookingDetails(Request $request)
    {
        dd($request);
    }

    public function storeBookDetailsSession(Request $request)
    {
        // dd($request);
        // if ($request->session()->get('book_details')) {
        //     $request->session()->forget('book_details');
        // }
        $saveBooking = Book::create([
            'id' => Uuid::generate()->string,
            'keke_id' => $request->keke_id,
            'user_id' => $request->user_id,
            'pick_up' => new Point(lat: $request->pickup_lat, lng: $request->pickup_lng),
            'destination' => new Point(lat: $request->destination_lat, lng: $request->destination_lng),
            'number_passengers' => $request->passengers,
            'status' => 1,
        ]);

        // $storeDetails = Session::put('book_details', [
        //     'user_id' => $request->get('user_id'),
        //     'pickup_lat' => $request->get('pickup_lat'),
        //     'pickup_lng' => $request->get('pickup_lng'),
        //     'destination_lat' => $request->get('destination_lat'),
        //     'destination_lng' => $request->get('destination_lng'),
        // ]);

        // dd(Session::get('book_details')['pickup_lng']);
        // dd($request->session()->get('book_details'));

        if (!$saveBooking) {
            return response()->json(['error' => 'Booking Details Not Saved']);
        }
        return response()->json(['success' => 'Booking Details Saved. Your Ride Will Be With You Shortly']);
    }
}
