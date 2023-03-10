<?php

namespace App\Http\Controllers\Rider;

use App\Events\SendPosition;
use App\Http\Controllers\Controller;
use App\Models\TripHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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
        if (!$tripHistory) {
            return response()->json(['error' => 'Trip Not Started']);
        }
        return response()->json(['success' => 'Trip Started Successfully.']);
    }

    public function stopTrip(Request $request)
    {
        $tripHistory = TripHistory::where('rider_id', $request->rider_id)->where('status', 1)->first();
        $tripHistory->status = 0;
        $tripHistory->end_trip_time = Carbon::now();
        $tripHistory->end_location = new Point(lat: $request->latitude, lng: $request->longitude);

        if (!$tripHistory->save()) {
            return response()->json(['error' => 'Trip Not Ended']);
        }
        return response()->json(['success' => 'Trip Ended Successfully.']);
    }

    public function updateTrip(Request $request)
    {
        $id = Auth::user()->id;
        $location = new Point(lat: $request->latitude, lng: $request->longitude);
        // dd($request);
        // $tripHistory = TripHistory::where('rider_id', $request->rider_id)->where('status', 1)->first();
        $tripHistory = TripHistory::where('rider_id', $id)->where('status', 1)->where('end_location', null)->get();
        // ->update([
        //     "update_trip_time" => Carbon::now(), 
        //     "current_location" => new Point(lat: $request->latitude, lng: $request->longitude)
        // ]);
        // dd($tripHistory); 
        // $tripHistory->status = 0;
        if (!$tripHistory) {
            return response()->json(['success' => 'There is no Ongoing Trips']);
        }
        // if($tripHistory->save == 1){
        //     return response()->json(['success'=>'This THas Ended']);
        // }

        foreach($tripHistory as $data){
            $data->update_trip_time = Carbon::now();
            $data->current_location = $location;
            $data->update();
        }
        

        // if (!$tripHistory->update()) {
        //     return response()->json(['success'=>'Trip Location Not Updated. Contact Admin']);
        // }
        return response()->json(['success' => 'Trip Location Updated Successfully.']);
    }

    public function updateTripEvent()
    {
        $event = ["text" =>'Event Triggered'];
        event(new SendPosition($event));
        Log::info('Send Position Success');
    }
}
