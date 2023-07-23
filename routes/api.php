<?php

use App\Http\Controllers\LearningPlanController;
use App\Http\Controllers\TemplateController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('template-detail', [TemplateController::class, 'apiStore'])->name('template-detail.apiStore');
Route::patch('template-detail', [TemplateController::class, 'apiUpdate'])->name('template-detail.apiUpdate');
Route::patch('rps-detail', [LearningPlanController::class, 'apiUpdate'])->name('rps-detail.apiUpdate');
Route::patch('template-detail/position', [TemplateController::class, 'apiChangePosition'])->name('template-detail.apiChangePosition');
