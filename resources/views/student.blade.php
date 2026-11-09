<x-app-layout>
    <x-slot name="title">Profil Mahasiswa</x-slot>

    <x-slot name="header">
        <x-page-header eyebrow="Akademik" title="Profil Mahasiswa"
                       subtitle="Detail mahasiswa berdasarkan NRP." />
    </x-slot>

    @php
        $initials = collect(explode(' ', $nama))->filter()->take(2)
            ->map(fn ($part) => mb_strtoupper(mb_substr($part, 0, 1)))->implode('');
    @endphp

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            {{-- Cover --}}
            <div class="h-28 bg-gradient-to-r from-indigo-600 via-indigo-500 to-sky-500"></div>

            <div class="px-6 sm:px-8 pb-8">
                <div class="-mt-12 flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">
                    <div class="flex items-end gap-4">
                        <span class="flex h-24 w-24 items-center justify-center rounded-2xl bg-white text-3xl font-bold text-indigo-600 shadow-md ring-4 ring-white">
                            {{ $initials }}
                        </span>
                        <div class="pb-1">
                            <h2 class="text-xl font-bold text-slate-900">{{ $nama }}</h2>
                            <p class="text-sm text-slate-500">NRP {{ $nrp }} &middot; {{ $departemen }}</p>
                        </div>
                    </div>

                    <span class="inline-flex w-fit items-center gap-1.5 rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700 ring-1 ring-inset ring-emerald-200">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                        {{ $status }}
                    </span>
                </div>

                <div class="mt-8 grid gap-3 sm:grid-cols-2">
                    <x-info-card label="Nama" value="{{ $nama }}" />
                    <x-info-card label="NRP" value="{{ $nrp }}" />
                    <x-info-card label="Departemen" value="{{ $departemen }}" />
                    <x-info-card label="Universitas" value="{{ $universitas }}" />
                    <x-info-card label="Status" value="{{ $status }}" />
                    <x-info-card label="Minat Akademik" value="{{ $minat }}" />
                </div>

                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="{{ route('ipk.form') }}" class="inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-indigo-500 transition">
                        Hitung IPK
                    </a>
                    <a href="{{ route('project') }}" class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 hover:bg-slate-50 transition">
                        Lihat Rencana Proyek
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
