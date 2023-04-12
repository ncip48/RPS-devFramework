<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlah_dosen = 10;
        $jumlah_fakultas = 5;
        $jumlah_prodi = 2;
        $jumlah_user = User::count();
        $jumlah_matkul = 1;
        $jumlah_rps = 2;

        return view('admin.dashboard.show', compact('jumlah_dosen', 'jumlah_fakultas', 'jumlah_prodi', 'jumlah_user', 'jumlah_matkul', 'jumlah_rps'));
    }
}
