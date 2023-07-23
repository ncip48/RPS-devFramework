<?php

namespace App\Http\Controllers;

use App\Http\Requests\PersonalRequest;
use App\Models\Institute;
use App\Models\Personal;
use App\Models\Teacher;
use Illuminate\Http\Request;

class PersonalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guard = $this->getGuard();
        if ($guard == 'institute') {
            $personals = Personal::join('institutes', 'institutes.id', '=', 'personals.id_institute')
                ->join('teachers', 'teachers.id', '=', 'personals.id_teacher')
                ->select('personals.*', 'institutes.name as institute_name', 'teachers.name as teacher_name')
                ->where('institutes.id', '=', auth()->guard('institute')->user()->id)
                ->get();

            return view('personal.index', compact('personals'));
        } else {
            $personals = Personal::join('institutes', 'institutes.id', '=', 'personals.id_institute')
                ->join('teachers', 'teachers.id', '=', 'personals.id_teacher')
                ->select('personals.*', 'institutes.name as institute_name', 'teachers.name as teacher_name')
                ->get();

            return view('personal.index', compact('personals'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $institutes = Institute::all();
        $guard = $this->getGuard();
        if ($guard == 'institute') {
            $teachers = Teacher::where('id_institute', '=', auth()->guard('institute')->user()->id)->get();
        } else {
            $teachers = Teacher::all();
        }

        return view('personal.add', compact('institutes', 'teachers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PersonalRequest $request)
    {
        $data = $request->validated();
        $teacher = Teacher::find($request->id_teacher);
        $data['name'] = $teacher->name;
        $data['password'] = bcrypt($request->password);
        $data['id_institute'] = $request->id_institute;

        $personal = Personal::where('id_teacher', '=', $request->id_teacher)->first();
        if ($personal) {
            return redirect()->back()->withErrors(['id_teacher' => 'Pengajar sudah terdaftar']);
        }

        Personal::create($data);

        return redirect()->route('personal.index')->with('success', 'Berhasil menambahkan personal baru.');
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
        $personal = Personal::find($id);
        $personal->delete();

        return redirect()->route('personal.index')->with('success', 'Berhasil menghapus personal.');
    }
}
