<x-app-layout>
    <x-slot name="title">Dashboard</x-slot>

    @php
        $user = Auth::user();
        $jam = now()->timezone('Asia/Jakarta')->hour;
        $sapaan = match (true) {
            $jam < 11 => 'Selamat pagi',
            $jam < 15 => 'Selamat siang',
            $jam < 18 => 'Selamat sore',
            default   => 'Selamat malam',
        };
        $role = $user->getRoleNames()->first() ?? 'Mahasiswa';

        $fitur = [
            [
                'judul' => 'Kalkulator IPK',
                'desc'  => 'Hitung rata-rata IPK dua semester lengkap dengan predikatnya.',
                'url'   => route('ipk.form'),
                'icon'  => 'M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342',
                'tone'  => 'bg-indigo-50 text-indigo-600',
            ],
            [
                'judul' => 'Profil Mahasiswa',
                'desc'  => 'Lihat data akademik: NRP, departemen, status, dan minat.',
                'url'   => route('student'),
                'icon'  => 'M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z',
                'tone'  => 'bg-emerald-50 text-emerald-600',
            ],
            [
                'judul' => 'Kalkulator',
                'desc'  => 'Operasi tambah, kurang, kali, dan bagi secara cepat.',
                'url'   => route('calculator'),
                'icon'  => 'M15.75 15.75V18m-7.5-6.75h.008v.008H8.25v-.008Zm0 2.25h.008v.008H8.25V13.5Zm0 2.25h.008v.008H8.25v-.008Zm0 2.25h.008v.008H8.25V18Zm2.498-6.75h.007v.008h-.007v-.008Zm0 2.25h.007v.008h-.007V13.5Zm0 2.25h.007v.008h-.007v-.008Zm0 2.25h.007v.008h-.007V18Zm2.504-6.75h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V13.5Zm0 2.25h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V18Zm2.498-6.75h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V13.5ZM8.25 6h7.5v2.25h-7.5V6ZM12 2.25c-1.892 0-3.758.11-5.593.322C5.307 2.7 4.5 3.65 4.5 4.757V19.5a2.25 2.25 0 0 0 2.25 2.25h10.5a2.25 2.25 0 0 0 2.25-2.25V4.757c0-1.108-.806-2.057-1.907-2.185A48.507 48.507 0 0 0 12 2.25Z',
                'tone'  => 'bg-amber-50 text-amber-600',
            ],
            [
                'judul' => 'Agentic AI',
                'desc'  => 'Ide proyek DAST berbasis Agentic AI untuk keamanan web.',
                'url'   => route('agent'),
                'icon'  => 'M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456Z',
                'tone'  => 'bg-violet-50 text-violet-600',
            ],
            [
                'judul' => 'Rencana Proyek Akhir',
                'desc'  => 'Database Health Checker & Performance Monitor Agent.',
                'url'   => route('project'),
                'icon'  => 'M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 5.625c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125',
                'tone'  => 'bg-sky-50 text-sky-600',
            ],
            [
                'judul' => 'Tentang Informatika ITS',
                'desc'  => 'Mengenal Departemen Teknik Informatika ITS.',
                'url'   => route('about'),
                'icon'  => 'M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0 0 12 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75Z',
                'tone'  => 'bg-rose-50 text-rose-600',
            ],
        ];
    @endphp

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-8">

        {{-- Hero --}}
        <section class="relative overflow-hidden rounded-2xl bg-slate-900 px-6 py-8 sm:px-10 sm:py-10 text-white">
            <div class="absolute -right-16 -top-16 h-64 w-64 rounded-full bg-indigo-500/30 blur-3xl"></div>
            <div class="absolute right-24 -bottom-20 h-48 w-48 rounded-full bg-sky-400/20 blur-3xl"></div>

            <div class="relative flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                <div>
                    <span class="inline-flex items-center rounded-full bg-white/10 px-3 py-1 text-xs font-medium text-indigo-100 ring-1 ring-inset ring-white/15">
                        {{ $role }}
                    </span>
                    <h1 class="mt-3 text-2xl sm:text-3xl font-bold tracking-tight">
                        {{ $sapaan }}, {{ \Illuminate\Support\Str::words($user->name, 2, '') }} 👋
                    </h1>
                    <p class="mt-2 max-w-xl text-sm text-slate-300">
                        Semua fitur akademikmu ada di sini. Mulai dengan menghitung IPK atau melihat profil mahasiswa.
                    </p>
                </div>

                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('ipk.form') }}" class="inline-flex items-center gap-2 rounded-lg bg-white px-4 py-2.5 text-sm font-semibold text-slate-900 hover:bg-indigo-50 transition">
                        Hitung IPK
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" /></svg>
                    </a>
                    @hasanyrole('Admin|Staf')
                        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2 rounded-lg bg-white/10 px-4 py-2.5 text-sm font-semibold text-white ring-1 ring-inset ring-white/20 hover:bg-white/20 transition">
                            Buka Admin Panel
                        </a>
                    @endhasanyrole
                </div>
            </div>
        </section>

        {{-- Fitur --}}
        <section>
            <div class="flex items-end justify-between mb-4">
                <div>
                    <h2 class="text-lg font-semibold text-slate-900">Fitur</h2>
                    <p class="text-sm text-slate-500">Akses cepat ke semua halaman aplikasi.</p>
                </div>
            </div>

            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($fitur as $item)
                    <a href="{{ $item['url'] }}"
                       class="group rounded-2xl border border-slate-200 bg-white p-5 shadow-sm hover:-translate-y-0.5 hover:border-indigo-200 hover:shadow-md transition">
                        <div class="flex items-start justify-between">
                            <span class="flex h-11 w-11 items-center justify-center rounded-xl {{ $item['tone'] }}">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $item['icon'] }}" />
                                </svg>
                            </span>
                            <svg class="h-5 w-5 text-slate-300 group-hover:text-indigo-500 group-hover:translate-x-0.5 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" /></svg>
                        </div>
                        <h3 class="mt-4 font-semibold text-slate-900">{{ $item['judul'] }}</h3>
                        <p class="mt-1 text-sm text-slate-500">{{ $item['desc'] }}</p>
                    </a>
                @endforeach
            </div>
        </section>
    </div>
</x-app-layout>
