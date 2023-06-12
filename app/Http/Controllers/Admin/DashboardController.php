<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\dosen;
use App\Models\fakultas;
use App\Models\Prodi;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlah_dosen = dosen::count();
        $jumlah_fakultas = fakultas::count();
        $jumlah_prodi = Prodi::count();
        $jumlah_user = User::count();
        $jumlah_matkul = 1;
        $jumlah_rps = 2;

        return view('admin.dashboard.show', compact('jumlah_dosen', 'jumlah_fakultas', 'jumlah_prodi', 'jumlah_user', 'jumlah_matkul', 'jumlah_rps'));
    }
}
