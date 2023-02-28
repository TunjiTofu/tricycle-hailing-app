<?php

namespace App\Http\Controllers\Passenger;

use App\Http\Controllers\Controller;
use App\Models\TripHistory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
}
