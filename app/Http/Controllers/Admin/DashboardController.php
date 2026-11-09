<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Tugas;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalMahasiswa' => Mahasiswa::count(), // tabel: mahasiswas
            'totalDosen'     => Dosen::count(),     // tabel: dosens
            'totalTugas'     => Tugas::count(),     // tabel: tugas
        ]);
    }
}
