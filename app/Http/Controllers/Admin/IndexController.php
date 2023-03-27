<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Keke;
use App\Models\Place;
use App\Models\TripHistory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        $admin = User::where('role', 'admin')->count();
        $rider = User::where('role', 'rider')->count();
        $user = User::where('role', 'user')->count();
        $place = Place::where('status', 1)->count();
        $kekes = Keke::count();
        $kekeTransit = TripHistory::where('status', 1)->count();
        $ordersTotal = Book::count();
        $ordersPending = Book::where('read', 1)->count();
        $totalAmount = Book::where('status', 0)->sum('amount');
        $dailyAmount = Book::where('status', 0)->whereDate('created_at', Carbon::today())->sum('amount');
        return view('admin.index', compact('profileData','admin','rider','user','place','kekes','kekeTransit','ordersTotal','ordersPending','totalAmount','dailyAmount'));
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
}
