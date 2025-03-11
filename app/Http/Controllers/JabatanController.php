<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jabatan;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jabatan = Jabatan::with('eselon')->get();
        return response()->json($jabatan);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_jabatan' => 'required',
            'id_eselon' => 'required|exists:eselon,id_eselon',
        ]);

        $jabatan = new Jabatan($validated);
        $jabatan->save();


        return response()->json(['message' => 'Jabatan berhasil ditambahkan', 'data' => $jabatan], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id_jabatan)
    {
        $jabatan = Jabatan::with('eselon')->where('id_jabatan', $id_jabatan)->firstOrFail();
        return response()->json($jabatan);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id_jabatan)
    {
        $jabatan = Jabatan::where('id_jabatan', $id_jabatan)->firstOrFail();

        $validated = $request->validate([
            'nama_jabatan' => 'sometimes|required',
            'id_eselon' => 'sometimes|required|exists:eselon,id_eselon',
        ]);

        $jabatan->update($validated);

        return response()->json(['message' => 'Jabatan berhasil diperbarui', 'data' => $jabatan]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_jabatan)
    {
        $jabatan = Jabatan::where('id_jabatan', $id)->firstOrFail();
        $jabatan->delete();

        return response()->json(['message' => 'Jabatan berhasil dihapus']);
    }
}
