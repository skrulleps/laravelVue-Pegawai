<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelamin;

class KelaminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Kelamin::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis_kelamin' => 'required',
        ]);

        $kelamin = Kelamin::create($validated);

        return response()->json(['message' => 'Jenis kelamin berhasil ditambahkan', 'data' => $kelamin], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id_jenKel)
    {
        return response()->json(Kelamin::where('id_jenKel', $id_jenKel)->firstOrFail());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id_jenKel)
    {
        $kelamin = Kelamin::where('id_jenKel', $id_jenKel)->firstOrFail();

        $validated = $request->validate([
            'jenis_kelamin' => 'sometimes|required',
        ]);
        $kelamin->update($validated);

        return response()->json(['message' => 'Data jenis kelamin berhasil diperbarui', 'data' => $kelamin]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_jenKel)
    {
        $kelamin = Kelamin::where('id_jenKel', $id_jenKel)->firstOrFail();
        $kelamin->delete();

        return response()->json(['message' => 'Data jenis kelamin berhasil dihapus']);
    }
}
