<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Department;
use App\Models\Institute;
use App\Models\Teacher;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guard = $this->getGuard();
        if ($guard == 'institute') {
            $courses = Course::join('departments', 'departments.id', '=', 'courses.id_department')
                ->join('institutes', 'institutes.id', '=', 'departments.id_institute')
                ->join('teachers', 'teachers.id', '=', 'courses.id_teacher')
                ->select('courses.*', 'departments.name as department_name', 'institutes.name as institute_name', 'teachers.name as teacher_name')
                ->where('institutes.id', '=', auth()->guard('institute')->user()->id)
                ->get();

            return view('course.index', compact('courses'));
        } else if ($this->isPersonalGuard()) {
            $courses = Course::join('departments', 'departments.id', '=', 'courses.id_department')
                ->join('institutes', 'institutes.id', '=', 'departments.id_institute')
                ->join('teachers', 'teachers.id', '=', 'courses.id_teacher')
                ->select('courses.*', 'departments.name as department_name', 'institutes.name as institute_name', 'teachers.name as teacher_name')
                ->where('teachers.id', '=', auth()->guard('personal')->user()->id)
                ->get();

            return view('course.index', compact('courses'));
        } else {
            $courses = Course::join('departments', 'departments.id', '=', 'courses.id_department')
                ->join('institutes', 'institutes.id', '=', 'departments.id_institute')
                ->join('teachers', 'teachers.id', '=', 'courses.id_teacher')
                ->select('courses.*', 'departments.name as department_name', 'institutes.name as institute_name', 'teachers.name as teacher_name')
                ->get();

            return view('course.index', compact('courses'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if ($this->isAdminGuard()) {
            $institutes = Institute::all();
            $teachers = Teacher::all();
            $departments = Department::all();
        } else {
            $institutes_id = $this->getInstituteId();
            $institutes = Institute::where('id', '=', $institutes_id)->get();
            $teachers = Teacher::where('id_institute', '=', $institutes_id)->get();
            $departments = Department::where('id_institute', '=', $institutes_id)->get();
        }

        return view('course.add', compact('institutes', 'teachers', 'departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_institute' => 'required',
            'id_department' => 'required',
            'id_teacher' => 'required',
            'code' => 'required',
            'name' => 'required',
            'credit' => 'required|integer',
        ]);

        Course::create($request->all());

        return redirect()->route('materi.index')->with('success', 'Berhasil menambahkan materi baru.');
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
        $course = Course::find($id);
        if ($this->isAdminGuard()) {
            $institutes = Institute::all();
            $teachers = Teacher::all();
            $departments = Department::all();
        } else {
            $institutes_id = $this->getInstituteId();
            $institutes = Institute::where('id', '=', $institutes_id)->get();
            $teachers = Teacher::where('id_institute', '=', $institutes_id)->get();
            $departments = Department::where('id_institute', '=', $institutes_id)->get();
        }

        return view('course.edit', compact('course', 'institutes', 'teachers', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'id_institute' => 'required',
            'id_department' => 'required',
            'id_teacher' => 'required',
            'code' => 'required',
            'name' => 'required',
            'credit' => 'required|integer',
        ]);

        Course::find($id)->update($request->all());

        return redirect()->route('materi.index')->with('success', 'Berhasil mengubah data materi.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Course::find($id)->delete();

        return redirect()->route('materi.index')->with('success', 'Berhasil menghapus data materi.');
    }
}
