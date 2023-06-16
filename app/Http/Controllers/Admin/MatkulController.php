<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Matkul;
use App\Models\Prodi;
use App\Models\Dosen;
use Illuminate\Http\Request;

class MatkulController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $matkuls = Matkul::select('matkuls.*', 'prodis.name as prodi', 'dosens.nama_dosen as dosen')
            ->join('prodis', 'prodis.id', '=', 'matkuls.id_prodi')
            ->join('dosens', 'dosens.id', '=', 'matkuls.id_dosen')
            ->paginate(10);

        return view('admin.matkul.show', compact('matkuls'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $prodis = Prodi::all();
        $dosens = Dosen::all();
        return view('admin.matkul.create', compact('prodis', 'dosens'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'nama_matkul' => 'required',
            'id_prodi' => 'required',
            'id_dosen' => 'required',
        ],
        [
            'nama_matkul.required' => 'Nama matkul tidak boleh kosong',
            'id_prodi.required' => 'Prodi tidak boleh kosong',
            'id_dosen.required' => 'Dosen tidak boleh kosong',
        ]);

        Matkul::create($request->all());
        return redirect()->route('admin.matkul.index')->with('success', 'matkul berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //edit matkul by id
        $matkul = Matkul::findOrFail($id);
        $prodis = Prodi::all();
        $dosens = Dosen::all();
        return view('admin.matkul.edit', compact('matkul', 'prodis', 'dosens'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'nama_matkul' => 'required',
            'id_prodi' => 'required',
            'id_dosen' => 'required',
        ],
        [
            'nama_matkul.required' => 'Nama matkul tidak boleh kosong',
            'id_prodi.required' => 'Prodi tidak boleh kosong',
            'id_dosen.required' => 'Dosen tidak boleh kosong',
        ]);

        // $matkul = Matkul::findOrFail($id);
        // $matkul->update($request->all());
        $matkul = Matkul::where('id', $id)->update([
            'nama_matkul' => $request->nama_matkul,
            'id_prodi' => $request->id_prodi,
            'id_dosen' => $request->id_dosen,
        ]);

        $matkul->save();
        return redirect()->route('admin.matkul.index')->with('success', 'matkul berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $matkul = Matkul::findOrFail($id);
        $matkul->delete();
        return redirect()->route('admin.matkul.index')->with('success', 'matkul berhasil dihapus');
    }
}
