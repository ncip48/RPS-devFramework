<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function index(Request $request)
    {
        $dosens = Dosen::when($request->search, function ($query) use ($request) {
            $query->where('nama_dosen', 'like', "%{$request->search}%")
                ->orWhere('nip', 'like', "%{$request->search}%");
        })->paginate(10);
        return view('admin.dosen.show', compact('dosens'));
    }
    public function create()
    {
        $dosens = Dosen::all();
        return view('admin.dosen.add', compact('dosens'));
    }  
    
    public function store(Request $request)
    {
        $request->validate(
            [
                'nama_dosen' => 'required',
                'nip' => 'required|unique:dosens',
                'jenis_kelamin' => 'required',
                'alamat_dosen' => 'required',
            ],
            [
                'nama_dosen.required' => 'Nama tidak boleh kosong',
                'nip.required' => 'NIP tidak boleh kosong',
                'nip.unique' => 'NIP sudah terdaftar',
                'jenis_kelamin.required' => 'Jenis Kelamin tidak boleh kosong',
                'alamat_dosen.required' => 'Alamat tidak boleh kosong',


            ]
        );

        $dosen = new Dosen();
        $dosen->nama_dosen = $request->nama_dosen;
        $dosen->nip = $request->nip;
        $dosen->jenis_kelamin = $request->jenis_kelamin;
        $dosen->alamat_dosen = $request->alamat_dosen;
        $dosen->save();

        return redirect()->route('admin.dosen.index')->with('success', 'dosen berhasil ditambahkan');
    }
    public function edit(Dosen $dosen)
    {
        $dosens = Dosen::all();
        return view('admin.dosen.edit', compact('dosen', 'dosens'));
    }
    public function update(Request $request, Dosen $dosen)
    {
        $request->validate([
            'nama_dosen' => 'required',
            'nip' => 'required',
            'alamat_dosen' => 'required',
            'jenis_kelamin' => 'required',
        ], [
            'nama_dosen.required' => 'Nama tidak boleh kosong',
            'nip.required' => 'NIP tidak boleh kosong',
            'alamat_dosen.required' => 'Alamat Dosen tidak boleh kosong',
            'jenis_kelamin.required' => 'Jenis Kelamin tidak boleh kosong',
        ]);

        $dosen->nama_dosen = $request->nama_dosen;
        $dosen->nip = $request->nip;
        $dosen->jenis_kelamin = $request->jenis_kelamin;
        $dosen->alamat_dosen = $request->alamat_dosen;
        $dosen->save();

        return redirect()->route('admin.dosen.index')->with('success', 'dosen berhasil diupdate');
    }
    public function destroy(Dosen $dosen)
    {
        $dosen = Dosen::find($dosen->id);
        $dosen->delete();

        return redirect()->route('admin.dosen.index')->with('success', 'dosen berhasil dihapus');
    }

}
