<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Fakultas;
use Illuminate\Http\Request;

class FakultasController extends Controller
{
    public function index(Request $request)
    {
        $fakultass = Fakultas::when($request->search, function ($query) use ($request) {
            $query->where('nama_fakultas', 'like', "%{$request->search}%")
                ->orWhere('id_dekan', 'like', "%{$request->search}%");
        })->paginate(10);
        return view('admin.fakultas.show', compact('fakultass'));
    }
    public function create()
    {
        $fakultass = Fakultas::all();
        return view('admin.fakultas.add', compact('fakultass'));
    }  
    
    public function store(Request $request)
    {
        $request->validate(
            [
                'nama_fakultas' => 'required',
                'id_dekan' => 'required|unique:fakultas',
                'nama_dekan' => 'required',
            ],
            [
                'nama_dekan.required' => 'Nama tidak boleh kosong',
                'id_dekan.required' => 'ID tidak boleh kosong',
                'id_dekan.unique' => 'ID sudah terdaftar',
                'nama_fakultas.required' => 'Nama fakultas tidak boleh kosong',
                


            ]
        );

        $fakultas = new Fakultas();
        $fakultas->nama_fakultas = $request->nama_fakultas;
        $fakultas->id_dekan = $request->id_dekan;
        $fakultas->nama_dekan = $request->nama_dekan;
        $fakultas->save();

        return redirect()->route('admin.fakultas.index')->with('success', 'fakultas berhasil ditambahkan');
    }
    public function edit(fakultas $fakultas)
    {
        $fakultass = Fakultas::all();
        return view('admin.fakultas.edit', compact('fakultas', 'fakultass'));
    }
    public function update(Request $request, Fakultas $fakultas)
    {
        $request->validate([
            'nama_fakultas' => 'required',
            'id_dekan' => 'required|unique:fakultas',
            'nama_dekan' => 'required',
        ], [
            'nama_dekan.required' => 'Nama tidak boleh kosong',
            'id_dekan.required' => 'ID tidak boleh kosong',
            'id_dekan.unique' => 'ID sudah terdaftar',
            'nama_fakultas.required' => 'Nama fakultas tidak boleh kosong',
        ]);

        $fakultas->nama_fakultas = $request->nama_fakultas;
        $fakultas->id_dekan = $request->id_dekan;
        $fakultas->nama_dekan = $request->nama_dekan;
        $fakultas->save();

        return redirect()->route('admin.fakultas.index')->with('success', 'fakultas berhasil diupdate');
    }
    public function destroy(Fakultas $fakultas)
    {
        $fakultas = Fakultas::find($fakultas->id);
        $fakultas->delete();

        return redirect()->route('admin.fakultas.index')->with('success', 'fakultas berhasil dihapus');
    }

}
