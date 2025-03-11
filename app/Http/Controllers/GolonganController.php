<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Golongan;


class GolonganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Golongan::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'golongan' => 'required',
            'pangkat' => 'required',
        ]);

        $golongan = Golongan::create($validated);

        return response()->json(['message' => 'Golongan berhasil ditambahkan', 'data' => $golongan], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id_golongan)
    {
        return response()->json(Golongan::where('id_golongan', $id_golongan)->firstOrFail());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id_golongan)
    {
        $golongan = Golongan::where('id_golongan', $id_golongan)->firstOrFail();

        $validated = $request->validate([
            'golongan' => 'sometimes|required',
            'pangkat' => 'sometimes|required',
        ]);

        $golongan->update($validated);

        return response()->json(['message' => 'Golongan berhasil diperbarui', 'data' => $golongan]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_golongan)
    {
        $golongan = Golongan::where('id_golongan', $id_golongan)->firstOrFail();
        $golongan->delete();

        return response()->json(['message' => 'Golongan berhasil dihapus']);
    }
}
