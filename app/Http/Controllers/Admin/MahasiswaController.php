<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Kolom tabel mahasiswas: id, nama, nrp, departemen, is_active, timestamps.
     */
    public function index(Request $request)
    {
        $mahasiswa = Mahasiswa::query()
            // 1. Pencarian berdasarkan nama ATAU nrp
            ->when($request->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%")
                      ->orWhere('nrp', 'like', "%{$search}%");
                });
            })
            // 2. Filter departemen
            ->when($request->departemen, function ($query, $departemen) {
                $query->where('departemen', $departemen);
            })
            // 3. Filter status (aktif / cuti -> kolom boolean is_active)
            ->when($request->status, function ($query, $status) {
                $query->where('is_active', $status === 'aktif');
            })
            ->orderBy('nama')
            ->paginate(10)
            // 4. Parameter pencarian & filter tetap terbawa saat pindah halaman
            ->withQueryString();

        $departemenList = ['Teknik Informatika', 'Sistem Informasi', 'Teknik Komputer'];

        return view('admin.mahasiswa.index', compact('mahasiswa', 'departemenList'));
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        // Pengamanan server-side (mencegah bypass lewat URL / Postman)
        abort_unless(auth()->user()->can('hapus-data'), 403, 'Anda tidak berhak menghapus data ini.');

        $nama = $mahasiswa->nama;
        $mahasiswa->delete();

        return back()->with('success', "Data mahasiswa {$nama} berhasil dihapus.");
    }
}
