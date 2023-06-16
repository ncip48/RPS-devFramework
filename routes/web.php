<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProdiController;
use App\Http\Controllers\Admin\DosenController;
use App\Http\Controllers\Admin\MatkulController;
use App\Http\Controllers\Admin\FakultasController;
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

Route::get('/', function () {
    echo "Hello";
});

Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    Route::group(['prefix' => 'components', 'as' => 'components.'], function () {
        Route::get('/alert', function () {
            return view('admin.component.alert');
        })->name('alert');
        Route::get('/accordion', function () {
            return view('admin.component.accordion');
        })->name('accordion');
    });
});

Auth::routes();

Route::middleware(['is_admin', 'auth'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.index');

        //masukkan rute admin disini
        Route::resource('dosen',DosenController::class)->names('admin.dosen');
        Route::resource('prodi', ProdiController::class)->names('admin.prodi');
        Route::resource('matkul', MatkulController::class)->names('admin.matkul');
        //route user
        Route::resource('user', UserController::class)->names('admin.user');
        Route::resource('fakultas', FakultasController::class)->names('admin.fakultas');
        

        
    });
    
});

