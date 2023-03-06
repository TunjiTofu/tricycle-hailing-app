<?php

namespace App\Http\Controllers\Passenger;

use App\Http\Controllers\Controller;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Webpatser\Uuid\Uuid;

class RatingController extends Controller
{
    public function rateTrip(Request $request)
    {
        // dd($request);
        $id = Auth::user()->id;
        $request->validate([
            'rider_id' => ['required', 'integer'], 
            'rating' => ['required', 'min:0', 'max:5'],
        ]);

        $checkRating = Rating::where('book_id', $request->book_id)->first();
        if (!$checkRating) {
            $saveRating = Rating::create([
                'id' => Uuid::generate()->string,
                'book_id' => $request->book_id,
                'rider_id' => $request->rider_id,
                'rating' => $request->rating,
                'user_id' => $id,
            ]);
            if (!$saveRating) {
                return response()->json(['error' => 'Rating Not Saved']);
            }
            return response()->json(['success' => 'Rating Saved']);
        }
        return response()->json(['error' => 'You have already rated this trip']);
    }
}
