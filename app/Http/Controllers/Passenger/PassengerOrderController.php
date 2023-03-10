<?php

namespace App\Http\Controllers\Passenger;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PassengerOrderController extends Controller
{
    public function viewAllOrders()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        $allOrders = Book::where('user_id', $id)->orderBy('created_at', 'desc')->get();
        return view('passenger.order.index', compact('allOrders', 'profileData'));
    }
}
