<?php

namespace App\Http\Controllers\Passenger;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PassengerController extends Controller
{
    public function PassengerDashboard()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        $checkUser = Book::where('user_id', $id)->where('status', 1)->first();
        $oderHistory = Book::where('user_id', $id)->where('status', 0)->orderBy('created_at', 'desc')->get();
        return view('passenger.index', compact('profileData', 'checkUser','oderHistory'));
    }

    public function destroy()
    {
        Session::flush();
        Auth::logout();

        session()->flash('message', 'Logout Successful');
        return redirect('/');
    }

    
}
 