<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Eselon;

class EselonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Agama::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_eselon' => 'required',
        ]);
        $eselon = Eselon::create($validated);

        return response()->json(['message' => 'Eselon berhasil ditambahkan', 'data' => $eselon], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id_eselon)
    {
        return response()->json(Eselon::where('id_eselon', $id_eselon)->firstOrFail());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id_eselon)
    {
        $eselon = Agama::where('id_agama', $id_eselon)->firstOrFail();

        $validated = $request->validate([
            'nama_agama' => 'sometimes|required',
        ]);

        $eselon->update($validated);

        return response()->json(['message' => 'Eselon berhasil diperbarui', 'data' => $eselon]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_eselon)
    {
        $eselon = Eselon::where('id_eselon', $id_eselon)->firstOrFail();
        $eselon->delete();

        return response()->json(['message' => 'Eselon berhasil dihapus']);
    }
}
