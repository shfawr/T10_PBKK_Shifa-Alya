@extends('adminlte::page')

@section('title', 'Dashboard Admin')

@section('content_header')
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
        <h1 class="m-0">Dashboard Admin</h1>
        <span class="text-body-secondary small">
            <i class="bi bi-person-circle me-1"></i>{{ Auth::user()->name }}
            &middot; {{ Auth::user()->getRoleNames()->implode(', ') }}
        </span>
    </div>
@stop

@section('content')
    {{-- Informasi akses berdasarkan role (Spatie) --}}
    @role('Admin')
        <div class="callout callout-danger mb-4">
            <h5 class="mb-1"><i class="bi bi-shield-lock me-1"></i> Anda login sebagai Admin</h5>
            <p class="mb-0">Anda memiliki akses penuh, termasuk menghapus data mahasiswa.</p>
        </div>
    @endrole

    @role('Staf')
        <div class="callout callout-info mb-4">
            <h5 class="mb-1"><i class="bi bi-info-circle me-1"></i> Anda login sebagai Staf</h5>
            <p class="mb-0">Akses Anda terbatas: dapat melihat data, tetapi tidak dapat menghapus.</p>
        </div>
    @endrole

    {{-- 3 Widget Statistik (komponen small-box AdminLTE) --}}
    <div class="row">
        <div class="col-lg-4 col-md-6">
            <x-adminlte-small-box
                title="{{ $totalMahasiswa }}"
                text="Total Mahasiswa"
                icon="bi bi-mortarboard-fill"
                theme="primary"
                url="{{ route('admin.mahasiswa.index') }}"
                url-text="Lihat data mahasiswa" />
        </div>

        <div class="col-lg-4 col-md-6">
            <x-adminlte-small-box
                title="{{ $totalDosen }}"
                text="Total Dosen"
                icon="bi bi-person-workspace"
                theme="success" />
        </div>

        <div class="col-lg-4 col-md-12">
            <x-adminlte-small-box
                title="{{ $totalTugas }}"
                text="Total Tugas"
                icon="bi bi-list-check"
                theme="warning" />
        </div>
    </div>

    {{-- Akses cepat --}}
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Akses Cepat</h3>
        </div>
        <div class="card-body d-flex flex-wrap gap-2">
            <a href="{{ route('admin.mahasiswa.index') }}" class="btn btn-primary">
                <i class="bi bi-table me-1"></i> Kelola Data Mahasiswa
            </a>
            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left-circle me-1"></i> Kembali ke Area User
            </a>
        </div>
    </div>
@stop

@section('footer')
    <div class="float-end d-none d-sm-inline">PBKK &middot; Pertemuan 10</div>
    <strong>&copy; {{ date('Y') }} ITS Academic.</strong> Shifa Alya Dewi.
@stop
