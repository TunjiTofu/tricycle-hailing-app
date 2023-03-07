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
        $allOrders = Book::where('rider_id', $id)->orderBy('created_at', 'desc')->get();
        return view('rider.order.index', compact('allOrders'));
    }

    public function markRead(Request $request)
    {
        dd($request->order_id);
    }
}
