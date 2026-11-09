<x-app-layout>
    <x-slot name="title">Beranda</x-slot>

    {{-- HERO --}}
    <section class="relative overflow-hidden border-b border-slate-200/70 bg-white">
        <div class="pointer-events-none absolute -top-40 right-0 h-[28rem] w-[28rem] rounded-full bg-indigo-100 blur-3xl"></div>
        <div class="pointer-events-none absolute -bottom-32 -left-20 h-72 w-72 rounded-full bg-sky-100 blur-3xl"></div>

        <div class="relative max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-24">
            <div class="grid items-center gap-12 lg:grid-cols-5">
                <div class="lg:col-span-3">
                    <span class="inline-flex items-center gap-2 rounded-full bg-indigo-50 px-3 py-1 text-xs font-semibold text-indigo-700 ring-1 ring-inset ring-indigo-200">
                        <span class="h-1.5 w-1.5 rounded-full bg-indigo-500"></span>
                        ITS Academic Profile
                    </span>

                    <h1 class="mt-5 text-4xl sm:text-5xl font-bold tracking-tight text-slate-900">
                        Selamat Datang 👋
                    </h1>
                    <p class="mt-4 max-w-xl text-lg text-slate-500">
                        Halo, saya <strong class="text-slate-800">Shifa Alya Dewi</strong>, mahasiswa
                        Teknik Informatika ITS semester 5.
                    </p>

                    {{-- STATUS BANNER DINAMIS (?user=Nama) --}}
                    <div class="mt-6 max-w-xl">
                        @if ($user)
                            <x-status-banner type="success">
                                Selamat datang, <strong>{{ $user }}</strong>!
                            </x-status-banner>
                        @else
                            <x-status-banner type="info">
                                Selamat datang di academic profile saya.
                            </x-status-banner>
                        @endif
                    </div>

                    <div class="mt-8 flex flex-wrap gap-3">
                        <a href="{{ route('student') }}" class="rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 transition">
                            Lihat Profil Lengkap &rarr;
                        </a>
                        @auth
                            <a href="{{ route('ipk.form') }}" class="rounded-xl border border-slate-300 bg-white px-5 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50 transition">
                                Hitung IPK
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="rounded-xl border border-slate-300 bg-white px-5 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50 transition">
                                Masuk untuk Kalkulator IPK
                            </a>
                        @endauth
                    </div>
                </div>

                {{-- KARTU PROFIL --}}
                <div class="lg:col-span-2">
                    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-xl shadow-slate-200/60">
                        <div class="flex items-center gap-4">
                            <span class="flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-br from-indigo-600 to-sky-500 text-2xl font-bold text-white">SA</span>
                            <div>
                                <p class="font-semibold text-slate-900">Shifa Alya Dewi</p>
                                <p class="text-sm text-slate-500">NRP 5025241176</p>
                            </div>
                        </div>
                        <dl class="mt-6 space-y-3 text-sm">
                            <div class="flex justify-between gap-4"><dt class="text-slate-500">Departemen</dt><dd class="font-medium text-slate-900 text-right">Teknik Informatika</dd></div>
                            <div class="flex justify-between gap-4"><dt class="text-slate-500">Universitas</dt><dd class="font-medium text-slate-900 text-right">ITS</dd></div>
                            <div class="flex justify-between gap-4"><dt class="text-slate-500">Minat</dt><dd class="font-medium text-slate-900 text-right">Web Development</dd></div>
                            <div class="flex justify-between gap-4">
                                <dt class="text-slate-500">Status</dt>
                                <dd><span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-2.5 py-0.5 text-xs font-semibold text-emerald-700"><span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>Aktif</span></dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- JELAJAHI --}}
    <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
        <h2 class="text-lg font-semibold text-slate-900">Jelajahi</h2>
        <p class="text-sm text-slate-500">Halaman-halaman di web profile ini.</p>

        <div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ([
                ['Profil Mahasiswa', 'Data akademik lengkap berdasarkan NRP.', route('student'), false],
                ['Rencana Proyek Akhir', 'Database Health Checker & Performance Monitor Agent.', route('project'), false],
                ['Agentic AI', 'Ide DAST berbasis Agentic AI untuk keamanan web.', route('agent'), false],
                ['Kalkulator IPK', 'Hitung rata-rata IPK dua semester beserta predikat.', route('ipk.form'), true],
            ] as [$judul, $desc, $url, $butuhLogin])
                <a href="{{ $url }}" class="group rounded-2xl border border-slate-200 bg-white p-5 shadow-sm hover:-translate-y-0.5 hover:border-indigo-200 hover:shadow-md transition">
                    <div class="flex items-center justify-between gap-2">
                        <h3 class="font-semibold text-slate-900">{{ $judul }}</h3>
                        @if ($butuhLogin && auth()->guest())
                            <span class="rounded-full bg-slate-100 px-2 py-0.5 text-[11px] font-medium text-slate-500">Perlu login</span>
                        @endif
                    </div>
                    <p class="mt-1 text-sm text-slate-500">{{ $desc }}</p>
                    <span class="mt-4 inline-block text-sm font-semibold text-indigo-600 group-hover:translate-x-0.5 transition">Buka &rarr;</span>
                </a>
            @endforeach
        </div>
    </section>
</x-app-layout>
