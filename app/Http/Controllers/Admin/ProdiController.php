<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\User;
use App\Models\Prodi;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $prodis = Prodi::select('prodis.*', 'users.name as fakultas', 'kaprodi.nama_dosen as kaprodi', 'sekprodi.nama_dosen as sekprodi')
            ->join('users', 'users.id', '=', 'prodis.id_fakultas')
            ->join('dosens as kaprodi', 'kaprodi.id', '=', 'prodis.id_kaprodi')
            ->join('dosens as sekprodi', 'sekprodi.id', '=', 'prodis.id_sekprodi')
            ->paginate(10);

        return view('admin.prodi.show', compact('prodis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $fakultases = User::all();
        $kaprodis = Dosen::all();
        $sekprodis = Dosen::all();
        return view('admin.prodi.add', compact('fakultases','kaprodis', 'sekprodis'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'id_fakultas' => 'required',
            'id_kaprodi' => 'required',
            'id_sekprodi' => 'required',
        ],
        [
            'name.required' => 'Nama tidak boleh kosong',
            'id_fakultas.required' => 'Fakultas tidak boleh kosong',
            'id_kaprodi.required' => 'Nama tidak boleh kosong',
            'id_sekprodi.required' => 'Nama tidak boleh kosong',
        ]);
        
        Prodi::create($request->all());
        
        return redirect()->route('admin.prodi.index')->with('success', 'prodi berhasil ditambahkan');
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // 
        $prodis = Prodi::find($id);
        $fakultases = User::all();
        $kaprodis = Dosen::all();
        $sekprodis = Dosen::all();
        return view('admin.prodi.edit', compact('prodis', 'fakultases', 'kaprodis', 'sekprodis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'name' => 'required', // nama prodi diganti name
            'id_fakultas' => 'required',
            'id_kaprodi' => 'required',
            'id_sekprodi' => 'required',
        ],
        [
            'name.required' => 'Nama tidak boleh kosong',
            'id_fakultas.required' => 'Fakultas tidak boleh kosong',
            'id_kaprodi.required' => 'Nama tidak boleh kosong',
            'id_sekprodi.required' => 'Nama tidak boleh kosong',
        ]);

        $prodi = Prodi::find($id);
        $prodi->name = $request->name;
        $prodi->id_fakultas = $request->id_fakultas;
        $prodi->id_kaprodi = $request->id_kaprodi;
        $prodi->id_sekprodi = $request->id_sekprodi;
        $prodi->save();

        return redirect()->route('admin.prodi.index')->with('success', 'prodi berhasil diubah');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prodi $prodi)
    {
        $prodi->delete();

        return redirect()->route('admin.prodi.index')->with('success', 'prodi berhasil dihapus');
        
    }
}
