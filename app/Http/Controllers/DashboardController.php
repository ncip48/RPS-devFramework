<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Department;
use App\Models\Institute;
use App\Models\Invoice;
use App\Models\LearningPlan;
use App\Models\Teacher;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $guard = $this->getGuard();
        if ($guard == 'web') {
            $sales = Invoice::where('status', 'paid')->sum('total');
            $dailySales = Invoice::where('status', 'paid')->whereDate('created_at', date('Y-m-d'))->sum('total');
            $monthlySales = Invoice::where('status', 'paid')->whereMonth('created_at', date('m'))->sum('total');
            $institutes = Institute::count();

            $countInstituteByPT = Institute::where('type', 'PT')->count();
            $countInstituteByOtherPT = Institute::whereNotIn('type', ['PT'])->count();
            $PTVsOtherPT = [$countInstituteByPT, $countInstituteByOtherPT];

            //grouping by type then make it as array example [1,2,3] if count is zero then set value to 0
            $instituteByType = Institute::selectRaw('type, count(*) as total')->groupBy('type')->pluck('total', 'type')->toArray();
            $instituteByType = array_merge(array_fill_keys(['TK', 'SD', 'SMP', 'SMA', 'SMK', 'PT'], 0), $instituteByType);

            // dd(auth()->guard('institute')->user());

            return view('dashboard', compact('sales', 'dailySales', 'monthlySales', 'institutes', 'PTVsOtherPT', 'instituteByType'));
        } else if ($guard == 'institute') {
            $institute = auth()->guard('institute')->user();
            $teachers = Teacher::where('id_institute', $institute->id)->count();
            $departments = Department::where('id_institute', $institute->id)->count();
            $rpses = LearningPlan::where('id_institute', $institute->id)->count();
            $invoices = Invoice::where('id_institute', $institute->id)->count();

            return view('dashboardInstitute', compact('teachers', 'departments', 'rpses', 'invoices'));
        } else if ($guard == 'personal') {
            $teacher = auth()->guard('personal')->user();
            $courses = Course::where('id_teacher', $teacher->id)->count();
            $rpses = LearningPlan::where('id_teacher', $teacher->id)->count();

            return view('dashboardPersonal', compact('courses', 'rpses'));
        }
    }
}
