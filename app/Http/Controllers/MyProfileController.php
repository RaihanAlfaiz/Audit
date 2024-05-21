<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyProfileController extends Controller
{
    public function myprofile()
{
    $user = Auth::user();
    return view('layouts.myprofile', compact('user'));
}


public function update(Request $request, $id)
{
    $user = Auth::user(); 

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $user->name = $request->name;
    $user->email = $request->email;

    if ($request->hasFile('photo')) {
        $photoPath = $request->file('photo')->store('photos', 'public');
        $user->photo = $photoPath;
    }

    $user->save();

    return redirect()->route('user.myprofile')->with('status', 'Profile updated successfully.');
}

}
