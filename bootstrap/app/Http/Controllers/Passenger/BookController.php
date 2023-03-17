<?php

namespace App\Http\Controllers\Passenger;

use App\Events\BookRide;
use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Keke;
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
        $rider = Keke::where('plate_no', $keke_id)->first();
        // $rider_id = $rider->rider_id;
        $request->validate([
            'keke_id' => 'required|string|max:9|regex:/Keke-\d\d\d\d/',
        ]);
        $numberOfBookings = Book::where('keke_id', $keke_id)->where('status', 1)->get();
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
        return view('passenger.book.details', compact('numberOfBookings', 'spaceAvailable', 'keke_id', 'rider', 'profileData'));
    }


    public function selectRide2()
    {
        $kekeSpace = 3;
        $spaceAvailable = 0;
        $numberOfPassengers = 0;
        $id = Auth::user()->id;
        $profileData = User::find($id);
        $keke_id = 'Keke-2638';
        $rider = Keke::where('plate_no', $keke_id)->first();
        // $rider_id = $rider->rider_id;
        // $request->validate([
        //     'keke_id' => 'required|string|max:9|regex:/Keke-\d\d\d\d/',
        // ]);
        $numberOfBookings = Book::where('keke_id', $keke_id)->where('status', 1)->get();
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
        return view('passenger.book.details_calculation', compact('numberOfBookings', 'spaceAvailable', 'keke_id', 'rider', 'profileData'));
    }


    public function storeBookingDetails(Request $request)
    {
        dd($request);
    }

    public function storeBookDetailsSession(Request $request)
    {
        // dd($request);
        $checkUser = Book::where('user_id', $request->user_id)->where('status', 1)->first();
        // dd($checkUser);
        if ($checkUser == null) {
            $saveBooking = Book::create([
                'id' => Uuid::generate()->string,
                'rider_id' => $request->rider_id,
                'keke_id' => $request->keke_id,
                'user_id' => $request->user_id,
                // new Point(lat: $request->latitude, lng: $request->longitude),
                'pick_up' => new Point(lat: $request->pickup_lat, lng: $request->pickup_lng),
                'destination' => new Point(lat: $request->destination_lat, lng: $request->destination_lng),
                'number_passengers' => $request->passengers,
                'distance' => $request->distance_in_kilo,
                'duration' => $request->duration_text,
                'amount' => $request->amount_payable,
                'status' => 1,
                'read' => 0,
            ]);
            if (!$saveBooking) {
                return response()->json(['error' => 'Booking Details Not Saved']);
            }
            $event = [
                "text" => 'Book Ride Event Triggered',
                'rider_id' => $request->rider_id,
                'user_id' => $request->user_id,
            ];
            event(new BookRide($event));
            // Log::info('Send Position Success');
            return response()->json(['success' => 'Booking Details Saved. Your Ride Will Be With You Shortly']);
        }
        return response()->json(['error' => 'You are currently on a trip!. Please end the trip before booking.']);
    }

    public function endTrip()
    {
        $id = Auth::user()->id;
        // dd($id);
        $checkUser = Book::where('user_id', $id)->where('status', 1)->first();
        $checkUser->status = 0;
        $checkUser->save();
        $notification = array(
            'message' => 'Your current trip has ended',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
