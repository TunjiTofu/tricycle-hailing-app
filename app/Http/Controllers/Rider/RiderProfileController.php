<?php

namespace App\Http\Controllers\Rider;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class RiderProfileController extends Controller
{
    public function index()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        $orderCount = Book::where('rider_id', $id)->where('read', 0)->where('status', 1)->count();
        return view('rider.profile.index', compact('profileData','orderCount'));
    }

    public function edit()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        $orderCount = Book::where('rider_id', $id)->where('read', 0)->where('status', 1)->count();
        $editData = User::find($id);
        return view('rider.profile.edit', compact('editData','profileData','orderCount'));
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $userData = User::find($id);
        $request->validate([
            'username' => ['required', 'string', 'max:8'],
            'email' => ['required', 'string', 'email', 'max:100'],
            'surname' => ['required', 'string', 'max:30'],
            'oname' => ['required', 'string', 'max:30'],
            'phone' => ['required', 'string', 'max:20'],
            'dob' => ['required', 'string'],
            'sex' => ['required', 'string', 'max:1', 'in:m,f'],
        ]);

        if ($request->file('photo')) {
            $image = $request->file('photo');
            @unlink($userData->picture);
            $newImageName = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();

            //resize with laravel image intervention
            Image::make($image)->resize(256, 256)->save('upload/profile_pics/' . $newImageName);
            $saveUrl = 'upload/profile_pics/' . $newImageName;

            User::findOrFail($id)->update([
                'username' => $request->username,
                'email' => $request->email,
                'surname' => $request->surname,
                'other_name' => $request->oname,
                'phone' => $request->phone,
                'dob' => $request->dob,
                'sex' => $request->sex,
                'picture' => $saveUrl,
                'updated_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => 'Profile Updated With Image Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('rider.profile')->with($notification);
        } else {
            User::findOrFail($id)->update([
                'username' => $request->username,
                'email' => $request->email,
                'surname' => $request->surname,
                'other_name' => $request->oname,
                'phone' => $request->phone,
                'dob' => $request->dob,
                'sex' => $request->sex,
                'updated_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => 'Profile Updated Without Image Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('rider.profile')->with($notification);
        }
    }

    public function passwordChange()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        $orderCount = Book::where('rider_id', $id)->where('read', 0)->where('status', 1)->count();
        return view('rider.profile.change-password', compact('profileData','orderCount'));
    }

    public function passwordUpdate(Request $request)
    {
        $request->validate([
            'old_password' => 'required|string',
            'new_password' => 'required|min:4',
            'confirm_password' => 'required|min:4|same:new_password',
        ]);

        $currentPassword = Auth::user()->password;
        if (Hash::check($request->old_password, $currentPassword)) {
            $user = User::find(Auth::id());
            $user->password = bcrypt($request->new_password);
            $user->save();

            session()->flash('message', 'Password Successfully Change');
            return redirect()->route('rider.logout');
        } else {
            $notification = array(
                'message' => 'Old Password Does Not Match',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    
}
