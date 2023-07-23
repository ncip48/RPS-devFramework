<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Department;
use App\Models\Institute;
use App\Models\Teacher;
use App\Models\Template;
use App\Models\TemplateFill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guard = $this->getGuard();
        if ($guard == 'institute') {
            $templates = Template::join('institutes', 'institutes.id', '=', 'templates.id_institute')
                ->join('courses', 'courses.id', '=', 'templates.id_course')
                ->join('departments', 'departments.id', '=', 'courses.id_department')
                ->join('teachers', 'teachers.id', '=', 'courses.id_teacher')
                ->select('templates.*', 'institutes.name as institute_name', 'courses.name as course_name', 'departments.name as department_name', 'teachers.name as teacher_name')
                ->where('institutes.id', '=', auth()->guard('institute')->user()->id)
                ->get();

            //find the id_teacher in templates with value example [1,2] then match to Teacher models
            $templates->map(function ($template) {
                $teachers = [];
                $template->id_teacher = explode(',', $template->id_teacher);
                foreach ($template->id_teacher as $id_teacher) {
                    $teacher = Teacher::find($id_teacher);
                    array_push($teachers, $teacher->name);
                }
                $template->teachers = $teachers;
            });

            return view('template.index', compact('templates'));
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
            $courses = Course::all();
        } else {
            $institutes_id = $this->getInstituteId();
            $institutes = Institute::where('id', '=', $institutes_id)->get();
            $teachers = Teacher::where('id_institute', '=', $institutes_id)->get();
            $departments = Department::where('id_institute', '=', $institutes_id)->get();
            $courses = Course::where('courses.id_institute', '=', $institutes_id)->join('teachers', 'teachers.id', '=', 'courses.id_teacher')->select('courses.*', 'teachers.name as teacher_name')->get();
        }
        return view('template.add', compact('institutes', 'teachers', 'departments', 'courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_institute' => 'required',
            'id_department' => 'required',
            'id_course' => 'required',
        ]);

        //get the id_teacher[]
        $id_teacher = $request->teacher;
        $request->request->add(['id_teacher' => $id_teacher]);
        $template = Template::create($request->all());

        // return redirect()->route('template-rps.index')->with('success', 'Template created successfully.');
        // return redirect()->
        //return redirect to  route('template-rps.show', $template)
        return redirect()->route('template-rps.show', $template)->with('success', 'Template created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $template = Template::join('institutes', 'institutes.id', '=', 'templates.id_institute')
            ->join('courses', 'courses.id', '=', 'templates.id_course')
            ->join('departments', 'departments.id', '=', 'courses.id_department')
            ->join('teachers', 'teachers.id', '=', 'courses.id_teacher')
            ->select('templates.*', 'institutes.name as institute_name', 'courses.name as course_name', 'departments.name as department_name', 'teachers.name as teacher_name')
            ->where('templates.id', '=', $id)
            ->first();

        //find the id_teacher in templates with value example [1,2] then match to Teacher models
        $teachers = [];
        $template->id_teacher = explode(',', $template->id_teacher);
        foreach ($template->id_teacher as $id_teacher) {
            $teacher = Teacher::find($id_teacher);
            array_push($teachers, $teacher->name);
        }
        $template->teachers = $teachers;

        $details = TemplateFill::where('template_fills.id_template', '=', $id)
            ->orderBy('template_fills.position', 'asc')
            ->get();

        return view('template.detail', compact('details', 'template'));
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
        Template::find($id)->delete();

        return redirect()->route('template-rps.index')->with('success', 'Template deleted successfully');
    }

    public function apiStore(Request $request)
    {
        //validation
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'type' => 'required',
        ], [
            'title.required' => 'Judul tidak boleh kosong',
            'type.required' => 'Tipe tidak boleh kosong',
        ]);

        if ($validator->fails()) {
            return $this->responseJson(false, 'Gagal menambahkan detail template', $validator->errors());
        }

        $template = new TemplateFill();
        //find the last position
        $last_position = TemplateFill::where('id_template', '=', $request->id_template)
            ->orderBy('position', 'desc')
            ->first();
        if ($last_position) {
            $template->position = $last_position->position + 1;
        } else {
            $template->position = 1;
        }
        $template->id_template = $request->id_template;
        $template->title = $request->title;
        $template->type = $request->type;
        //if request column
        if ($request->type == 'table') {
            $column = $request->column;
            //explode comma then make it like ["a", "b"]
            $column = explode(',', $column);
            //make it like ["a", "b"]
            $column = json_encode($column);
            $template->column = $column;
        } else {
            $template->column = null;
        }
        $template->save();

        return $this->responseJson(true, 'Berhasil menambahkan detail template', $template);
    }

    public function apiUpdate(Request $request)
    {
        //validation
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'type' => 'required',
        ], [
            'title.required' => 'Judul tidak boleh kosong',
            'type.required' => 'Tipe tidak boleh kosong',
        ]);

        if ($validator->fails()) {
            return $this->responseJson(false, 'Gagal mengubah detail template', $validator->errors());
        }

        $id = $request->id;

        $template = TemplateFill::find($id);
        $template->title = $request->title;
        $template->type = $request->type;
        //if request column
        if ($request->type == 'table') {
            $column = $request->column;
            //explode comma then make it like ["a", "b"]
            $column = explode(',', $column);
            //make it like ["a", "b"]
            $column = json_encode($column);
            $template->column = $column;
        } else {
            $template->column = null;
        }
        $template->save();

        return $this->responseJson(true, 'Berhasil mengubah detail template', $template);
    }

    public function apiChangePosition(Request $request)
    {
        $id = $request->id;
        $position = $request->position;
        $type = $request->type;

        $template = TemplateFill::find($id);
        if ($type == 'up') {
            //search the position before
            $position_before = $position;
            $position_after = $position_before + 1;
            $template_after = TemplateFill::where('id_template', '=', $template->id_template)
                ->where('position', '=', $position_after)
                ->first();
            //change the position
            $template->position = $position_before;
            $template_after->position = $position_after;
            //search the position before
            $template_before = TemplateFill::where('id_template', '=', $template->id_template)
                ->where('position', '=', $position_before)
                ->first();
            //change the position
            $template_before->position = $position_before + 1;
            $template_before->save();
            $template->save();
        } else {
            //search the position after
            $position_after = $position;
            $position_before = $position_after - 1;
            $template_before = TemplateFill::where('id_template', '=', $template->id_template)
                ->where('position', '=', $position_before)
                ->first();
            //change the position
            $template->position = $position_after;
            $template_before->position = $position_before;
            //search the position after
            $template_after = TemplateFill::where('id_template', '=', $template->id_template)
                ->where('position', '=', $position_after)
                ->first();
            //change the position
            $template_after->position = $position_after - 1;
            $template_after->save();
            $template->save();
        }

        // return $this->responseJson(true, 'Berhasil mengubah posisi detail template', $template);
        return redirect()->back();
    }
}
