<?php

namespace App\Http\Controllers;

use App\Http\Requests\LearningPlanRequest;
use App\Models\LearningPlan;
use App\Models\LearningPlanDetail;
use App\Models\Teacher;
use App\Models\Template;
use App\Models\TemplateFill;
use Illuminate\Http\Request;

class LearningPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $personal_id = auth()->guard('personal')->user()->id_teacher;
        $learning_plans = LearningPlan::join('templates', 'templates.id', '=', 'learning_plans.id_template')
            ->join('institutes', 'institutes.id', '=', 'learning_plans.id_institute')
            ->join('teachers', 'teachers.id', '=', 'learning_plans.id_teacher')
            ->join('courses', 'courses.id', '=', 'templates.id_course')
            ->select('learning_plans.*', 'institutes.name as institute_name', 'templates.id_teacher as id_teacher', 'teachers.name as creator_name', 'courses.name as course_name')
            ->whereRaw("CONCAT(',', templates.id_teacher, ',') LIKE '%,$personal_id,%'")
            ->get();

        $learning_plans = $learning_plans->map(function ($learning_plan) {
            $teachers = [];
            $learning_plan->id_teacher = explode(',', $learning_plan->id_teacher);
            foreach ($learning_plan->id_teacher as $id_teacher) {
                $teacher = Teacher::find($id_teacher);
                array_push($teachers, $teacher->name);
            }
            $learning_plan->teachers = $teachers;
            return $learning_plan;
        });

        // dd($learning_plans);
        return view('rps.index', compact('learning_plans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teacher_id = auth()->guard('personal')->user()->id_teacher;
        $templates = Template::join('courses', 'courses.id', '=', 'templates.id_course')
            ->select('templates.*', 'courses.name as course_name')
            ->whereRaw("CONCAT(',', templates.id_teacher, ',') LIKE '%,$teacher_id,%'")
            ->get();

        return view('rps.add', compact('templates'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LearningPlanRequest $request)
    {
        $personal_id = auth()->guard('personal')->user()->id_teacher;
        $data = $request->validated();
        $data['id_institute'] = auth()->guard('personal')->user()->id_institute;
        $data['id_teacher'] = $personal_id;
        $data['id_template'] = $request->id_template;
        $data['semester'] = $request->semester;
        $data['periode'] = $request->periode;
        LearningPlan::create($data);

        return redirect()->route('rps.index')->with('success', 'RPS berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $template = LearningPlan::where('learning_plans.id', $id)->join('templates', 'learning_plans.id_template', '=', 'templates.id')
            ->join('departments', 'templates.id_department', '=', 'departments.id')
            ->join('courses', 'templates.id_course', '=', 'courses.id')
            ->join('teachers', 'courses.id_teacher', '=', 'teachers.id')
            ->select('learning_plans.id_template', 'learning_plans.id', 'learning_plans.semester', 'learning_plans.periode',  'departments.name as department_name', 'courses.name as course_name', 'teachers.name as teacher_name', 'templates.id_teacher')
            ->first();

        //find the id_teacher in templates with value example [1,2] then match to Teacher models
        $teachers = [];
        $template->id_teacher = explode(',', $template->id_teacher);
        foreach ($template->id_teacher as $id_teacher) {
            $teacher = Teacher::find($id_teacher);
            array_push($teachers, $teacher->name);
        }
        $template->teachers = $teachers;

        // $id_template = LearningPlan::where('id', $id)->first();


        // $details = TemplateFill::join('learning_plans', 'learning_plans.id_template', '=', 'template_fills.id_template')
        //     ->where('learning_plans.id', $id)
        //     ->leftJoin('learning_plan_details', 'learning_plan_details.id_template_fill', '=', 'template_fills.id')
        //     ->select('template_fills.*', 'learning_plan_details.value', 'template_fills.id as id_template_fill')
        //     ->orderBy('template_fills.position', 'asc')
        //     ->get();

        $id_template = LearningPlan::where('id', $id)->first();

        $details = TemplateFill::where('template_fills.id_template', '=', $id_template->id_template)
            // ->leftJoin('learning_plan_details', 'learning_plan_details.id_template_fill', '=', 'template_fills.id')
            // ->select('template_fills.*', 'learning_plan_details.value', 'template_fills.id as id_template_fill')
            ->select('template_fills.*', 'template_fills.id as id_template_fill')
            ->orderBy('template_fills.position', 'asc')
            ->get();

        $learning_plan_details = LearningPlanDetail::where('id_learning_plan', $id)->get();

        $details = $details->map(function ($detail) use ($id, $learning_plan_details) {
            $detail->id_learning_plan = $id;
            $detail->value = $learning_plan_details->where('id_template_fill', $detail->id_template_fill)->first()->value ?? null;
            return $detail;
        });

        return view('rps.detail', compact('details', 'template'));
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
        $learning_plan = LearningPlan::find($id);
        $learning_plan->delete();

        return redirect()->route('rps.index')->with('success', 'RPS berhasil dihapus');
    }

    public function apiUpdate(Request $request)
    {
        $id = $request->id;
        $value = $request->value;
        $type = $request->type;
        $id_learning_plan = $request->id_learning_plan;
        $id_template_fill = $request->id_template_fill;
        if ($type == "text") {
            $value = $value;
            //append to LearningPlanDetail
            $learning_plan_details = LearningPlanDetail::where('id_template_fill', $id)->where('id_learning_plan', $id_learning_plan)->first();
            if (!$learning_plan_details) {
                $learning_plan_details = LearningPlanDetail::create([
                    'id_learning_plan' => $id_learning_plan,
                    'id_template_fill' => $id_template_fill,
                    'value' => $value
                ]);
            } else {
                $learning_plan_details->value = $value;
                $learning_plan_details->save();
            }
        } else {
            $value = json_encode($request->value);
            //append to LearningPlanDetail
            $learning_plan_details = LearningPlanDetail::where('id_template_fill', $id)->where('id_learning_plan', $id_learning_plan)->first();
            if (!$learning_plan_details) {
                $value = $request->value;
                $learning_plan_details = LearningPlanDetail::create([
                    'id_learning_plan' => $id_learning_plan,
                    'id_template_fill' => $id_template_fill,
                    'value' => json_encode([$value])
                ]);
            } else {
                $value = $learning_plan_details->value;
                $value = json_decode($value);
                array_push($value, $request->value);
                $value = json_encode($value);
                $learning_plan_details = LearningPlanDetail::where('id_template_fill', $id)->where('id_learning_plan', $id_learning_plan)->first();
                $learning_plan_details->value = $value;
                $learning_plan_details->save();
            }
        }
        return $this->responseJson(true, 'Data berhasil diubah', $learning_plan_details);
    }
}
