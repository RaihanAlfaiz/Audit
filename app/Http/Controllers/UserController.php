<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\UserRole;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = User::all();
        $roles = Role::all(); // Assuming you have a Role model and you retrieve all roles
        return view('profile.index', [
            'user' => $user,
            'roles' => $roles, // Pass the roles variable to the view
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:5|max:255'
        ]);

        // Buat pengguna baru
        $user = User::create($validatedData);

        // Tetapkan peran default (misalnya, 'student')
        $defaultRole = Role::where('title', 'Guest')->first();

        // Attach peran default kepada pengguna
        if ($defaultRole) {
            $user->roles()->attach($defaultRole);
        }

        return redirect()->route('profile')->with('success', 'User berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all(); // Ambil semua peran dari database
        return view('profile.edit', compact('user', 'roles')); // Kirim data peran ke tampilan
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validasi input
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id' // Pastikan semua peran yang dipilih valid
        ]);

        // Update data pengguna
        $user->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email']
        ]);

        // Update peran pengguna
        $user->roles()->sync($validatedData['roles']); // Sinkronkan peran baru

        return redirect()->route('profile')->with('success', 'User berhasil Di edit.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('profile')->with('success', 'User berhasil dihapus.');
    }
    public function accepted(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->status = $request->status;
        $user->save();

        return redirect()->back()->with('success', 'Status updated successfully.');
    }
}
