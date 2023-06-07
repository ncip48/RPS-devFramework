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
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $matkul->delete();
        return redirect()->route('admin.matkul.index')->with('success', 'matkul berhasil dihapus');
    }
}
