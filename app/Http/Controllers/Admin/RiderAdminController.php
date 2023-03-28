<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Validation\Rules;

class RiderAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() :View
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        // $kekes = Keke::latest()->get();
        $riders = User::where('role', 'rider')->orderBy('surname', 'asc')->get();
        return view('admin.rider.index', compact('riders','profileData'));
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
        // dd($request);
        $request->validate([
            'username' => ['required', 'string', 'max:8', 'unique:' . User::class],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:' . User::class],
            'surname' => ['required', 'string', 'max:30'],
            'oname' => ['required', 'string', 'max:30'],
            'phone' => ['required', 'string', 'max:20', 'unique:' . User::class],
            'dob' => ['required', 'string'],
            'sex' => ['required', 'string', 'max:1', 'in:m,f'],
            'photo' => ['required'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $image = $request->file('photo');
        $newImageName = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();

        //resize with laravel image intervention
        Image::make($image)->resize(256, 256)->save('upload/profile_pics/' . $newImageName);
        $saveUrl = 'upload/profile_pics/' . $newImageName;

        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'surname' => $request->surname,
            'other_name' => $request->oname,
            'phone' => $request->phone,
            'dob' => $request->dob,
            'sex' => $request->sex,
            'role' => 'rider',
            'status' => 'active',
            'password' => Hash::make($request->password),
            'picture' => $saveUrl,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'A New Rider Has Been Added',
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
    public function show($id): View
    {
        $userId = Auth::user()->id;
        $profileData = User::find($userId);
        $rider = User::find($id);
        return view('admin.rider.show', compact('rider','profileData'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id): View
    {
        $userId = Auth::user()->id;
        $profileData = User::find($userId);
        $rider = User::find($id);
        return view('admin.rider.edit', compact('rider','profileData'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
