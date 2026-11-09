<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MahasiswaController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Publik - Web Profile (pertemuan 1-9)
|--------------------------------------------------------------------------
*/
Route::get('/', [PageController::class, 'index'])->name('home');
Route::redirect('/home', '/');
Route::view('/about', 'about')->name('about');
Route::view('/project', 'project')->name('project');

Route::get('/student/{nrp?}', [PageController::class, 'student'])
    ->where('nrp', '[0-9]+')
    ->name('student');

Route::get('/agent/{tema?}', [PageController::class, 'agent'])->name('agent');

/*
|--------------------------------------------------------------------------
| Area User (Breeze + Tailwind) -> middleware: auth
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Dashboard User (tujuan redirect user biasa setelah login)
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Kalkulator IPK (dari project lama)
    // /kalkulator-ipk            -> form input
    // /kalkulator-ipk/3.50/3.75  -> hasil perhitungan
    Route::get('/kalkulator-ipk', [PageController::class, 'ipkForm'])->name('ipk.form');
    Route::get('/kalkulator-ipk/{ipk1}/{ipk2}', [PageController::class, 'ipk'])
        ->where(['ipk1' => '[0-9]+(\.[0-9]+)?', 'ipk2' => '[0-9]+(\.[0-9]+)?'])
        ->name('ipk');

    // Kalkulator sederhana
    Route::get('/kalkulator', [PageController::class, 'calculator'])->name('calculator');

    // Profil akun (Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Area Admin (AdminLTE) -> middleware: auth + role:Admin|Staf
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:Admin|Staf'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index');

        Route::delete('/mahasiswa/{mahasiswa}', [MahasiswaController::class, 'destroy'])
            ->middleware('permission:hapus-data')
            ->name('mahasiswa.destroy');
    });

require __DIR__.'/auth.php';
