<?php

namespace App\Http\Controllers\Rider;

use App\Http\Controllers\Controller;
use App\Models\TripHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Webpatser\Uuid\Uuid;
use TarfinLabs\LaravelSpatial\Types\Point;

class TripHistoryController extends Controller
{
    public function startTrip(Request $request)
    {
        // dd($request->latitude);
        // $trip = TripHistory::find($request->user_id);
        
        $tripHistory = TripHistory::create([
            'id' => Uuid::generate()->string,
            'rider_id' => $request->rider_id,
            'keke_id' => $request->keke_id,
            'status' => 1,
            'start_trip_time' => Carbon::now(),
            'start_location' => new Point(lat: $request->latitude, lng: $request->longitude),
            // 'current_location' => null,
            // 'end_trip_time' => null,
            // 'end_location' => null,
        ]);
        if(!$tripHistory){
        return response()->json(['error'=>'Trip Not Started']);
        }
        return response()->json(['success'=>'Trip Started Successfully.']);
    }
}
