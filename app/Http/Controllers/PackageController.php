<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Http\Requests\StorePackageRequest;
use App\Http\Requests\UpdatePackageRequest;
use Illuminate\Http\Request;
use App\Models\UserRole;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = auth()->id(); // Mengambil ID user yang sedang login

        // Mengambil roles user
        $userRoles = UserRole::where('user_id', $userId)
            ->join('roles', 'user_roles.role_id', '=', 'roles.id')
            ->pluck('roles.id'); // Mengambil semua role titles sebagai array

        // Mengambil packages sesuai dengan role user
        $package = Package::whereIn('type', $userRoles)->get();
        // $package = Package::all();
        return view('pack.index', [
            'package' => $package
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pack.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'service' => 'required',
            'item' => 'required',
            'price' => 'required|numeric',
            'type' => 'required',
            'pack' => 'required',

        ]);

        // Buat pengguna baru
        $event = Package::create($validatedData);



        return redirect()->route('package')->with('success', 'Package added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $package = Package::findOrFail($id);
        return view('pack.show', compact('package')); // Kirim data peran ke tampilan
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $package = Package::findOrFail($id);
        return view('pack.edit', compact('package')); // Kirim data peran ke tampilan
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $package = Package::findOrFail($id);
        $validatedData = $request->validate([
            'name' => 'required',
            'service' => 'required',
            'item' => 'required',
            'price' => 'required|numeric',
            'type' => 'required',
            'pack' => 'required',
        ]);

        $package->fill($validatedData);
        $package->save();

        return redirect()->route('package')->with('success', 'package updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $package = Package::findOrFail($id);
        $package->delete();

        return redirect()->route('package')->with('success', 'package was successfully deleted.');
    }
}
