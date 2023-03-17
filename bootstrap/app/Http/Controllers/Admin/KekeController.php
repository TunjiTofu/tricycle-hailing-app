<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Keke;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Webpatser\Uuid\Uuid;

class KekeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        $kekes = Keke::latest()->get();
        $riders = User::where('role', 'rider')->where('status','active')->get();
        return view('admin.keke.index', compact('kekes','riders','profileData'));
        // return View::make('admin.keke.index')->with('kekes', $kekes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'rider_id' => 'required|numeric|unique:' . Keke::class,
            'plate_no' => 'required|string|max:9|regex:/Keke-\d\d\d\d/|unique:' . Keke::class,
            'color' => 'required',
        ], [
            'rider_id.required' => 'The Rider Field is Required',
            'rider_id.unique' => 'The Selected Rider is Already Engaged',
            'plate_no.required' => 'The Plate Number Field is Required',
            'plate_no.unique' => 'This ID has Been Registered to a Keke',
            'plate_no.regex' => 'The Plate Number Field Pattern is: Keke-#### where (#) is any number',
            'color.required' => 'The Color Field is Required',
        ]);
        Keke::insert([
            'id' => Uuid::generate()->string,
            'rider_id' => $request->rider_id,
            'plate_no' => $request->plate_no,
            'color' => $request->color,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'A New Keke Has Been Added',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id):View
    {
        $keke = Keke::findOrFail($id);
        $riders = User::where('role', 'rider')->where('status','active')->get();
        return view('admin.keke.edit', compact('keke','riders'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'rider_id' => 'required|string|numeric',
            'plate_no' => 'required|string|max:9|regex:/Keke-\d\d\d\d/',
            'color' => 'required',
        ], [
            'rider_id.required' => 'The Rider Field is Required',
            'plate_no.required' => 'The Plate Number Field is Required',
            'plate_no.regex' => 'The Plate Number Field Pattern is: Keke-#### where (#) is any number',
            'color.required' => 'The Color Field is Required',
        ]);
        Keke::findOrfail($id)->update([
            'rider_id' => $request->rider_id,
            'plate_no' => $request->plate_no,
            'color' => $request->color,
            'updated_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => "Keke With ID: $id Has Been Updated",
            'alert-type' => 'success'
        );
        return redirect()->route('keke.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $keke= Keke::findOrFail($id);
        $plateNo = $keke->plate_no;
        $keke->delete();
        $notification = array(
            'message' => "Keke With ID: $plateNo Has Been Deleted",
            'alert-type' => 'info'
        );
        return redirect()->route('keke.index')->with($notification);
    }
}
