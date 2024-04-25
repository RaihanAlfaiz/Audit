<?php

namespace App\Http\Controllers;

use App\DataTables\RoleDataTable;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $role = Role::all();
        return view('roles.index', [
            'roles' => $role
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return 'create role page';
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'id' => 'required',
            'title' => 'required',
        ]);

        // Update data pengguna
        $role = Role::create([
            'id' => $data['id'],
            'title' => $data['title']
        ]);

        return redirect()->route('roles')->with('success', 'Role berhasil ditambahkan.');
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
        $roles = Role::findOrFail($id);
        // Ambil semua peran dari database
        return view('roles.edit', compact('roles')); // Kirim data peran ke tampilan
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        // Validasi input
        $validatedData = $request->validate([
            'id' => 'required',
            'title' => 'required',
        ]);

        // Update data pengguna
        $role->update([
            'id' => $validatedData['id'],
            'title' => $validatedData['title']
        ]);


        return redirect()->route('roles')->with('success', 'Role berhasil Di edit.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('roles')->with('success', 'Role berhasil dihapus.');
    }
}
