<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Intervention\Image\Facades\Image;


class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
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

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'surname' => $request->surname,
            'other_name' => $request->oname,
            'phone' => $request->phone,
            'dob' => $request->dob,
            'sex' => $request->sex,
            'role' => 'user',
            'status' => 'active',
            'password' => Hash::make($request->password),
            'picture' => $saveUrl,
            'created_at' => Carbon::now(),
        ]);


        //event(new Registered($user));

        Auth::login($user);

        return redirect()->route('login');
    }
}
