<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeacherRequest;
use App\Models\Institute;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guard = $this->getGuard();
        if ($guard == 'institute') {
            $teachers = Teacher::join('institutes', 'institutes.id', '=', 'teachers.id_institute')
                ->select('teachers.*', 'institutes.name as institute_name')
                ->where('institutes.id', '=', auth()->guard('institute')->user()->id)
                ->get();
            return view('teacher.index', compact('teachers'));
        } else {
            $teachers = Teacher::join('institutes', 'institutes.id', '=', 'teachers.id_institute')
                ->select('teachers.*', 'institutes.name as institute_name')
                ->get();
            return view('teacher.index', compact('teachers'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $institutes = Institute::all();

        return view('teacher.add', compact('institutes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TeacherRequest $request)
    {
        Teacher::create($request->validated());
        return redirect()->route('pengajar.index')->with('success', 'Berhasil menambahkan pengajar baru.');
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
        $teacher = Teacher::find($id);
        $institutes = Institute::all();

        return view('teacher.edit', compact('teacher', 'institutes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TeacherRequest $request, string $id)
    {
        Teacher::find($id)->update($request->validated());
        return redirect()->route('pengajar.index')->with('success', 'Berhasil mengubah data pengajar.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Teacher::find($id)->delete();
        return redirect()->route('pengajar.index')->with('success', 'Berhasil menghapus data pengajar.');
    }
}
