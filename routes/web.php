<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProdiController;
use App\Http\Controllers\Admin\DosenController;
use App\Http\Controllers\Admin\FakultasController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InstistuteController;
use App\Http\Controllers\LearningPlanController;
use App\Http\Controllers\PersonalController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\TemplateFillController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware(['is_auth'])->group(function () {
    Route::get('auth', [AuthController::class, 'index'])->name('auth');
    Route::get('su', [AuthController::class, 'admin'])->name('auth.admin');
    Route::post('auth/login', [AuthController::class, 'login'])->name('login');
    Route::get('join', [AuthController::class, 'join'])->name('join');
    Route::post('auth/register', [AuthController::class, 'register'])->name('register');
});
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['is_login'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('produk', ProductController::class);
    Route::resource('institusi', InstistuteController::class);
    Route::resource('pengajar', TeacherController::class);
    Route::resource('jurusan', DepartmentController::class);
    Route::resource('materi', CourseController::class);
    Route::resource('personal', PersonalController::class);
    Route::resource('template-rps', TemplateController::class);
    Route::resource('template-detail', TemplateFillController::class);
    Route::resource('rps', LearningPlanController::class);
    Route::post('rps/{id}/print', [LearningPlanController::class, 'print'])->name('rps.print');
    Route::get('panduan', [HomeController::class, 'panduan'])->name('panduan');
});

// Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
//     Route::group(['prefix' => 'components', 'as' => 'components.'], function () {
//         Route::get('/alert', function () {
//             return view('admin.component.alert');
//         })->name('alert');
//         Route::get('/accordion', function () {
//             return view('admin.component.accordion');
//         })->name('accordion');
//     });
// });

// Auth::routes();

Route::get('test', [TestController::class, 'test'])->name('test');
