<x-app-layout>
    <x-slot name="title">Tentang</x-slot>

    <x-slot name="header">
        <x-page-header eyebrow="Tentang" title="Tentang Teknik Informatika ITS"
                       subtitle="Mengenal Departemen Teknik Informatika ITS." />
    </x-slot>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <article class="max-w-3xl rounded-2xl border border-slate-200 bg-white p-6 sm:p-8 shadow-sm">
            <div class="space-y-4 leading-relaxed text-slate-600">
                <p>
                    Departemen Teknik Informatika ITS merupakan bagian dari
                    Institut Teknologi Sepuluh Nopember yang berfokus pada
                    pendidikan dan pengembangan ilmu di bidang teknologi
                    informasi, komputer, dan rekayasa perangkat lunak.
                </p>
                <p>
                    Departemen ini menjadi lingkungan pembelajaran untuk
                    mengembangkan kemampuan mahasiswa dalam bidang
                    teknologi informasi dan ilmu komputer.
                </p>
            </div>

            <div class="mt-8 grid gap-3 sm:grid-cols-3">
                @foreach (['Rekayasa Perangkat Lunak', 'Teknologi Informasi', 'Ilmu Komputer'] as $bidang)
                    <div class="rounded-xl bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-700">{{ $bidang }}</div>
                @endforeach
            </div>
        </article>
    </div>
</x-app-layout>
