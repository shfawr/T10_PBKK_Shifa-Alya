<x-app-layout>
    <x-slot name="title">Rencana Proyek Akhir</x-slot>

    <x-slot name="header">
        <x-page-header eyebrow="Proyek" title="Rencana Proyek Akhir"
                       subtitle="Ide Platform Agentic AI." />
    </x-slot>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <article class="max-w-3xl rounded-2xl border border-slate-200 bg-white p-6 sm:p-8 shadow-sm">
            <span class="inline-flex items-center rounded-full bg-indigo-50 px-3 py-1 text-xs font-semibold text-indigo-700 ring-1 ring-inset ring-indigo-200">
                Agentic AI
            </span>

            <h2 class="mt-4 text-2xl font-bold tracking-tight text-slate-900">
                Database Health Checker &amp; Performance Monitor Agent
            </h2>

            <div class="mt-4 space-y-4 leading-relaxed text-slate-600">
                <p>
                    Kelompok kami berencana mengembangkan platform Agentic AI
                    yang dapat membantu pengguna memeriksa kondisi dan performa
                    database secara otomatis.
                </p>
                <p>
                    Agent akan menganalisis kondisi database, mengidentifikasi
                    masalah yang mungkin terjadi, serta memberikan informasi
                    dan rekomendasi untuk membantu meningkatkan performa
                    database.
                </p>
            </div>

            <div class="mt-8 grid gap-3 sm:grid-cols-3">
                @foreach (['Analisis Kondisi', 'Deteksi Masalah', 'Rekomendasi'] as $tahap)
                    <div class="rounded-xl border border-slate-200 px-4 py-3 text-sm font-semibold text-slate-700">
                        <span class="me-1 text-indigo-600">0{{ $loop->iteration }}</span> {{ $tahap }}
                    </div>
                @endforeach
            </div>
        </article>
    </div>
</x-app-layout>
