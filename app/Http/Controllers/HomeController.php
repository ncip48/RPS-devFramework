<?php

namespace App\Http\Controllers;

use App\Models\Institute;
use App\Models\Invoice;
use App\Models\LearningPlan;
use App\Models\Personal;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::orderBy('id', 'asc')->get();
        $countInstitute = Institute::count();
        $countLearningPlan = LearningPlan::count();
        $countPersonal = Personal::count();
        $transaction = Invoice::sum('total');
        return view('home', compact('products', 'countInstitute', 'countLearningPlan', 'countPersonal', 'transaction'));
    }

    public function panduan()
    {
        return view('panduan');
    }
}
