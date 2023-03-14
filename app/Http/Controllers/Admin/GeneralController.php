<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\TripHistory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GeneralController extends Controller
{
    public function kekeTransit()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        $kekes = TripHistory::where('status', 1)->get();
        // dd($kekes);
        return view('admin.keke.transit', compact('kekes', 'profileData'));
    }

    public function kekeOrderHistory()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        $orders = Book::orderBy('created_at', 'desc')->get();
        // dd($orders);
        return view('admin.keke.orders', compact('orders','profileData'));
    }
}
