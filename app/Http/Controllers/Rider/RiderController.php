<?php

namespace App\Http\Controllers\Rider;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\User;
use App\Models\Keke;
use App\Models\Rating;
use App\Models\TripHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiderController extends Controller
{
    public function RiderDashboard()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        $kekeData = Keke::firstWhere('rider_id', $id);
        $tripHistory = TripHistory::where('rider_id', $id)->where('status', 1)->first();
        $orderCount = Book::where('rider_id', $id)->where('read', 0)->where('status', 1)->count();
        $ratings = Rating::where('rider_id', $id)->get();
        $totalRatingApprox = 0;

        if ($ratings->count() > 0) {
            $totalRated = 0;
            $totalRating = 0;
            $totalRatingApprox = 0;
            foreach ($ratings as $rating) {
                $userRating = $rating->rating;
                $totalRated += $userRating;
                // echo 'User Rated - ' . $totalRated . '<br>';
            }
            // echo 'total User Rated - ' . $totalRated . '<br>';
            $RatingCount = count($ratings) . '<br>';
            // echo 'Rating Count - ' . $RatingCount . '<br>';
            $maximumRating = (int)$RatingCount * 5;
            // echo 'Maximum Rating - ' . $maximumRating . '<br>';
            $totalRating = ($totalRated / $maximumRating) * 5;
            // echo 'Rating Count - ' . $totalRating . '<br>';
            // echo 'Rating Count 2- ' . round($totalRating* 2)/2 . '<br>';
            $totalRatingApprox = round($totalRating * 2) / 2;
        }
        return view('rider.index', compact('profileData', 'kekeData', 'tripHistory', 'orderCount', 'totalRatingApprox'));
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

        // return redirect('/login')->with($notification);
        return redirect('/')->with($notification);

    }

    public function changeStatus(Request $request)
    {
        // dd($request);
        $user = User::find($request->user_id);
        $user->status = $request->status;
        $user->save();
        return response()->json(['success' => 'Status Updated Successfully.']);
    }
}
