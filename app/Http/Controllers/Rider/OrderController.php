<?php

namespace App\Http\Controllers\Rider;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function viewOrders()
    {
        $id = Auth::user()->id;
        $allOrders = Book::where('rider_id', $id)->where('read', 0)->orderBy('created_at', 'desc')->get();
        return view('rider.order.index', compact('allOrders'));
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
