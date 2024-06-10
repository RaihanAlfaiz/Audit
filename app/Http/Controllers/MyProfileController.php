<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class MyProfileController extends Controller
{
    public function myprofile()
    {
        $user = Auth::user();
        return view('layouts.myprofile', compact('user'));
    }

    public function update(Request $request, $id)
    {
        request()->validate([
            'name'       => 'required|string|min:2|max:100',
            'email'      => 'required|email|unique:users,email,' . $id,
            'old_password' => 'nullable|string',
            'password' => 'nullable|required_with:old_password|string|confirmed|min:6'
        ]);

        $user = User::find($id);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('old_password')) {
            if (Hash::check($request->old_password, $user->password)) {
                $user->update([
                    'password' => Hash::make($request->password)
                ]);
            } else {
                return back()
                    ->withErrors(['old_password' => __('Please enter the correct password')])
                    ->withInput();
            }
        }

        if ($request->hasFile('photo')) {
            if ($user->photo && file_exists(storage_path('app/public/photos/' . $user->photo))) {
                Storage::delete('public/photos/' . $user->photo);
            }

            $file = $request->file('photo');
            $fileName = $file->hashName();
            $file->storeAs('public/photos', $fileName);
            $user->photo = $fileName;
        }

        $user->save();

        return back()->with('status', 'Profile updated!');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = Auth::user();

        if ($request->file('profile_image')) {
            $imagePath = $request->file('profile_image')->store('photos', 'public');
            $user->photo = basename($imagePath);
            $user->save();
        }

        return back()->with('status', 'Profile image updated!');
    }
}
