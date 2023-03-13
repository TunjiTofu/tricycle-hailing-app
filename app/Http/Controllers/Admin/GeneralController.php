<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TripHistory;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    public function kekeTransit()
    {
        $kekes = TripHistory::where('status', 1)->get();
        // dd($kekes);
        return view('admin.keke.transit', compact('kekes'));
    }
}
