<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agama;

class AgamaController extends Controller
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
            'nama_agama' => 'required',
        ]);

        $agama = Agama::create($validated);

        return response()->json(['message' => 'Agama berhasil ditambahkan', 'data' => $agama], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id_agama)
    {
        return response()->json(Agama::where('id_agama', $id_agama)->firstOrFail());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id_agama)
    {
        $agama = Agama::where('id_agama', $id_agama)->firstOrFail();

        $validated = $request->validate([
            'nama_agama' => 'sometimes|required',
        ]);

        $agama->update($validated);

        return response()->json(['message' => 'Data Agama berhasil diperbarui', 'data' => $agama]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_agama)
    {
        $agama = Agama::where('id_agama', $id_agama)->firstOrFail();
        $agama->delete();

        return response()->json(['message' => 'Data Agama berhasil dihapus']);
    }
}
