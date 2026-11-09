@extends('adminlte::page')

@section('title', 'Data Mahasiswa')

@section('content_header')
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
        <h1 class="m-0">Data Mahasiswa</h1>
        <span class="badge text-bg-secondary fs-6 fw-normal">{{ $mahasiswa->total() }} data</span>
    </div>
@stop

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-1"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
    @endif

    {{-- Form Pencarian & Filter --}}
    <div class="card card-primary card-outline mb-4">
        <div class="card-header">
            <h3 class="card-title"><i class="bi bi-funnel me-1"></i> Pencarian & Filter</h3>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('admin.mahasiswa.index') }}" class="row g-2">
                <div class="col-lg-4">
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-search"></i></span>
                        <input type="text" name="search" class="form-control"
                               placeholder="Cari nama / NRP..." value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <select name="departemen" class="form-select">
                        <option value="">-- Semua Departemen --</option>
                        @foreach ($departemenList as $dept)
                            <option value="{{ $dept }}" @selected(request('departemen') === $dept)>{{ $dept }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 col-lg-2">
                    <select name="status" class="form-select">
                        <option value="">-- Semua Status --</option>
                        <option value="aktif" @selected(request('status') === 'aktif')>Aktif</option>
                        <option value="cuti" @selected(request('status') === 'cuti')>Cuti</option>
                    </select>
                </div>
                <div class="col-lg-3 d-flex gap-2">
                    <button type="submit" class="btn btn-primary flex-grow-1">
                        <i class="bi bi-search me-1"></i> Cari Data
                    </button>
                    <a href="{{ route('admin.mahasiswa.index') }}" class="btn btn-outline-secondary" title="Reset">
                        <i class="bi bi-arrow-counterclockwise"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>

    {{-- Tabel Data --}}
    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th style="width: 60px">No</th>
                            <th>Nama</th>
                            <th>NRP</th>
                            <th>Departemen</th>
                            <th>Status</th>
                            <th class="text-end" style="width: 140px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($mahasiswa as $index => $mhs)
                            <tr>
                                <td>{{ $mahasiswa->firstItem() + $index }}</td>
                                <td class="fw-semibold">{{ $mhs->nama }}</td>
                                <td>{{ $mhs->nrp }}</td>
                                <td>{{ $mhs->departemen }}</td>
                                <td>
                                    <span class="badge {{ $mhs->is_active ? 'text-bg-success' : 'text-bg-danger' }}">
                                        {{ $mhs->is_active ? 'Aktif' : 'Cuti' }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    {{-- Proteksi UI: tombol hanya tampil untuk pemilik izin 'hapus-data' --}}
                                    @can('hapus-data')
                                        <form action="{{ route('admin.mahasiswa.destroy', $mhs->id) }}" method="POST" class="d-inline"
                                              onsubmit="return confirm('Yakin ingin menghapus data {{ addslashes($mhs->nama) }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-body-secondary small"><i class="bi bi-lock"></i> Hanya lihat</span>
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-body-secondary py-4">Data tidak ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Pagination Bootstrap 5 (sesuai AdminLTE 4) --}}
        @if ($mahasiswa->hasPages())
            <div class="card-footer clearfix">
                {{ $mahasiswa->onEachSide(1)->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
@stop

@section('footer')
    <div class="float-end d-none d-sm-inline">PBKK &middot; Pertemuan 10</div>
    <strong>&copy; {{ date('Y') }} ITS Academic.</strong> Shifa Alya Dewi.
@stop
