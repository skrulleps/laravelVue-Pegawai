<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Pegawai;
use Illuminate\Support\Facades\Storage;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pegawai = Pegawai::with(['kelamin', 'agama', 'unitKerja'])->get();
        return response()->json($pegawai);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nip' => 'required|unique:pegawai,nip',
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required|date',
            'id_kelamin' => 'required|exists:kelamin,id_jenKel',
            'alamat' => 'required',
            'id_agama' => 'required|exists:agama,id_agama',
            'id_unit' => 'required|exists:unit_kerja,id_unit',
            'tempat_tugas' => 'required',
            'no_hp' => 'required',
            'npwp' => 'nullable',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $pegawai = new Pegawai($validated);

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('public/foto-pegawai');
            $pegawai->foto = str_replace('public/', '', $path);
        }

        $pegawai->save();

        return response()->json(['message' => 'Pegawai berhasil ditambahkan', 'data' => $pegawai], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id_pegawai)
    {
        $pegawai = Pegawai::with(['kelamin', 'agama', 'unitKerja'])
        ->where('id_pegawai', $id_pegawai)
        ->firstOrFail(); 

        return response()->json($pegawai);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_pegawai)
    {
        $pegawai = Pegawai::where('id_pegawai', $id_pegawai)->firstOrFail();

        $validated = $request->validate([
            'nama' => 'sometimes|required',
            'tempat_lahir' => 'sometimes|required',
            'tgl_lahir' => 'sometimes|required|date',
            'id_kelamin' => 'sometimes|required|exists:kelamin,id_jenKel',
            'alamat' => 'sometimes|required',
            'id_agama' => 'sometimes|required|exists:agama,id_agama',
            'id_unit' => 'sometimes|required|exists:unit_kerja,id_unit',
            'tempat_tugas' => 'sometimes|required',
            'no_hp' => 'sometimes|required',
            'npwp' => 'nullable',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if (!empty($validated)) {
            $pegawai->fill($validated);
        }

        if ($request->hasFile('foto')) {
            if ($pegawai->foto) {
                Storage::delete('public/foto-pegawai/' . $pegawai->foto);
            }
            $path = $request->file('foto')->store('foto-pegawai', 'public');
            $pegawai->foto = $path;
        }

        $pegawai->save();

        return response()->json(['message' => 'Pegawai berhasil diperbarui', 'data' => $pegawai]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_pegawai)
    {
        $pegawai = Pegawai::where('id_pegawai', $id_pegawai)->firstOrFail();

        if ($pegawai->foto) {
            Storage::delete('public/' . $pegawai->foto);
        }

        $pegawai->delete();

        return response()->json(['message' => 'Pegawai berhasil dihapus']);
    }
}
