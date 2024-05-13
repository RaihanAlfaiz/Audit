<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $service = Service::All();
        return view('service.index', [
            'service' => $service
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('service.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'unit' => 'required',
            'unit_name' => 'required',
            'item' => 'required',
            'price' => 'required|numeric',


        ]);

        // Buat pengguna baru
        $event = Service::create($validatedData);



        return redirect()->route('service')->with('success', 'Service added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $service = Service::findOrFail($id);
        return view('service.edit', compact('service')); // Kirim data peran ke tampilan
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $service = Service::findOrFail($id);
        $validatedData = $request->validate([
            'unit' => 'required',
            'unit_name' => 'required',
            'item' => 'required',
            'price' => 'required|numeric',
        ]);

        $service->fill($validatedData);
        $service->save();

        return redirect()->route('service')->with('success', 'service updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $service = Service::findOrFail($id);
        $service->delete();

        return redirect()->route('service')->with('success', 'service was successfully deleted.');
    }
}
