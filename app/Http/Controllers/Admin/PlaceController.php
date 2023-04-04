<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Place;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
// use TarfinLabs\LaravelSpatial\Types\Point;
use TarfinLabs\LaravelSpatial\Types\Point;
use Webpatser\Uuid\Uuid;

class PlaceController extends Controller
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
        $places = Place::latest()->get();
        return view('admin.place.index', compact('places','profileData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('admin.place.create',compact('profileData'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'name' => 'required|string|min:3|unique:' . Place::class,
            'longitude' => ['required', 'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'latitude' => ['required', 'regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
        ], [
            'name.required' => 'The Location Name Field is Required',
            'name.unique' => 'This Location Exists in the Database',
            'longitude.required' => 'The Longitude Field is Required',
            'latitude.required' => 'The Latitude Field is Required',
        ]);
        Place::create([
            'id' => Uuid::generate()->string,
            'name' => $request->name,
            'coordinates' => new Point(lat: $request->latitude, lng: $request->longitude),
            'status' => 1,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'A New Location Has Been Added',
            'alert-type' => 'success'
        );
        return redirect()->route('place.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): View
    {
        // dd($id);
        $place = Place::findOrFail($id);
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('admin.place.view-place', compact('place','profileData'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id): View
    {
        $place = Place::findOrFail($id);
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('admin.place.edit', compact('place','profileData'));
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
        // dd($id);
        $request->validate([
            'name' => 'required|string|min:3',
            'status' => 'required|numeric|in:0,1',
            'longitude' => ['required', 'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'latitude' => ['required', 'regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
        ], [
            'name.required' => 'The Location Name Field is Required',
            'name.unique' => 'This Location Exists in the Database',
            'longitude.required' => 'The Longitude Field is Required',
            'latitude.required' => 'The Latitude Field is Required',
            'status.required' => 'The Status Field is Required',
            'status.numeric' => 'The Status Field is Required',
            'status.in' => 'The Status Field Option Must Be Either Enable or Disable',
        ]);

        $place = Place::findOrFail($id);
        $place->name = $request->name;
        $place->status = $request->status;
        $place->coordinates = new Point(lat: $request->latitude, lng: $request->longitude);
        $place->updated_at = Carbon::now();

        if (!$place->save()) {
            $notificationError = array(
                'message' => "Location Not Updated",
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notificationError);
        }

        $notification = array(
            'message' => "Location Has Been Updated",
            'alert-type' => 'success'
        );
        return redirect()->route('place.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $place= Place::findOrFail($id);
        $place->delete();
        $notification = array(
            'message' => "Location Has Been Deleted",
            'alert-type' => 'info'
        );
        return redirect()->route('place.index')->with($notification);
    }
}
