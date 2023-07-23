<?php

namespace App\Http\Controllers;

use App\Models\LearningPlan;
use App\Models\LearningPlanDetail;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test()
    {
        //join with id_department, id_course
        $rps = LearningPlan::find(1)->join('templates', 'learning_plans.id_template', '=', 'templates.id')
            ->join('departments', 'templates.id_department', '=', 'departments.id')
            ->join('courses', 'templates.id_course', '=', 'courses.id')
            ->join('teachers', 'courses.id_teacher', '=', 'teachers.id')
            ->select('learning_plans.semester', 'learning_plans.periode',  'departments.name as department_name', 'courses.name as course_name', 'teachers.name as teacher_name')
            ->first();

        // dd($rps);

        $rps_detail = LearningPlanDetail::where('id_learning_plan', 1)->get();

        $rps_detail = $rps_detail->map(function ($item) {
            $template_fill = $item->join('template_fills', 'learning_plan_details.id_template_fill', '=', 'template_fills.id')
                ->select('template_fills.title', 'template_fills.type', 'template_fills.column')
                ->where('learning_plan_details.id', $item->id)
                ->first();
            $item->title = $template_fill->title;
            $item->type = $template_fill->type;
            $item->column = $template_fill->column;
            return $item;
        });

        dd($rps_detail);

        echo "<b>Jurusan: $rps->department_name</b><br />";
        echo "<b>Mata Kuliah: $rps->course_name</b><br />";
        echo "<b>Pengampu: $rps->teacher_name</b><br />";
        echo "<b>Semester: $rps->semester</b><br />";
        echo "<b>Periode: $rps->periode</b><br />";
        //loop through rps_detail
        foreach ($rps_detail as $detail) {
            echo "<b>$detail->title</b><br />";
            if ($detail->type != 'table') {
                echo "$detail->value<br />";
            } else {
                //find and when same rowspan the value
                $table = json_decode($detail->column);
                $table_value = json_decode($detail->value);
                echo "<table border='1'>";
                echo "<tr>";
                foreach ($table as $column) {
                    echo "<th>$column</th>";
                }
                echo "</tr>";
                foreach ($table_value as $row) {
                    echo "<tr>";
                    foreach ($row as $column) {
                        echo "<td>$column</td>";
                    }
                    echo "</tr>";
                }
                echo "</table>";
            }
        }
    }
}
