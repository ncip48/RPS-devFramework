<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Institute;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guard = $this->getGuard();
        if ($guard == 'institute') {
            $departments = Department::join('institutes', 'institutes.id', '=', 'departments.id_institute')
                ->select('departments.*', 'institutes.name as institute_name')
                ->where('institutes.id', '=', auth()->guard('institute')->user()->id)
                ->get();

            return view('department.index', compact('departments'));
        } else {
            $departments = Department::join('institutes', 'institutes.id', '=', 'departments.id_institute')
                ->select('departments.*', 'institutes.name as institute_name')
                ->get();

            return view('department.index', compact('departments'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $institutes = Institute::all();

        return view('department.add', compact('institutes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_institute' => 'required',
            'code' => 'required',
            'name' => 'required',
        ], [
            'id_institute.required' => 'Institute harus diisi.',
            'code.required' => 'Kode harus diisi.',
            'name.required' => 'Nama harus diisi.',
        ]);

        Department::create($request->all());

        return redirect()->route('jurusan.index')->with('success', 'Berhasil menambahkan jurusan baru.');
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
        $department = Department::find($id);
        $institutes = Institute::all();

        return view('department.edit', compact('department', 'institutes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'id_institute' => 'required',
            'code' => 'required',
            'name' => 'required',
        ], [
            'id_institute.required' => 'Institute harus diisi.',
            'code.required' => 'Kode harus diisi.',
            'name.required' => 'Nama harus diisi.',
        ]);

        $department = Department::find($id);
        $department->update($request->all());

        return redirect()->route('jurusan.index')->with('success', 'Berhasil mengubah data jurusan.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $department = Department::find($id);
        $department->delete();

        return redirect()->route('jurusan.index')->with('success', 'Berhasil menghapus data jurusan.');
    }
}
