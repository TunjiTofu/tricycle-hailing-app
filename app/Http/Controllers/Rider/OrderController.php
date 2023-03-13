<?php

namespace App\Http\Controllers\Rider;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function viewPendingOrders()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        $allOrders = Book::where('rider_id', $id)->where('read', 0)->where('status', 1)->orderBy('created_at', 'desc')->get();
        $orderCount = Book::where('rider_id', $id)->where('read', 0)->where('status', 1)->count();
        return view('rider.order.index', compact('allOrders','orderCount','profileData'));
    }

    public function viewAllOrders()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        $allOrders = Book::where('rider_id', $id)->orderBy('created_at', 'desc')->get();
        $orderCount = Book::where('rider_id', $id)->where('read', 0)->where('status', 1)->count();
        return view('rider.order.history', compact('allOrders','orderCount','profileData'));
    }

    public function readOrder($id)
    {
        $allOrders = Book::where('id', $id)->first();
        $allOrders->read = 1;
        $allOrders->save();
        $notification = array(
            'message' => 'Order marked as Read',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);
    }

    public function helpMe(Request $request)
    {
        // if ($request->ajax()) {
        //     dd('Hi');
        // }
        $id = Auth::user()->id;
        dd($id);
    }
}
