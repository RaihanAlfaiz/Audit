<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use Illuminate\Validation\Rule;

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

        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'old_password' => 'nullable|required_with:password',
            'password' => 'nullable|string|min:8|confirmed',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Update data user
        $user->name = $request->name;
        $user->email = $request->email;

        // Update password jika ada input password baru
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Check if receipt_dp is uploaded
        if ($request->hasFile('photo')) {
            // Delete old image if exists
            if ($user->photo) {
                Storage::delete($user->photo);
            }

            $user->photo = $request->file('photo')->store('photo-images');
        }

        $user->save();

        return redirect()->route('myprofile')->with('status', 'Profile updated successfully');
    }
}
