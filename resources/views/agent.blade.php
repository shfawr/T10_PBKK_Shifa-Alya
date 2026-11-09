<x-app-layout>
    <x-slot name="title">Agentic AI</x-slot>

    @php $dark = $mode === 'dark'; @endphp

    <section @class(['py-12 sm:py-16 transition-colors', 'bg-slate-950' => $dark])>
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Toggle mode --}}
            <div class="mb-6 flex justify-end">
                <div @class(['inline-flex rounded-xl p-1 text-sm font-medium', 'bg-slate-800' => $dark, 'bg-slate-200/70' => ! $dark])>
                    <a href="{{ route('agent', ['tema' => $tema === 'General Assistant Agent' ? null : $tema]) }}"
                       @class(['rounded-lg px-3 py-1.5 transition', 'bg-white text-slate-900 shadow-sm' => ! $dark, 'text-slate-400 hover:text-white' => $dark])>
                        Terang
                    </a>
                    <a href="{{ route('agent', ['tema' => $tema === 'General Assistant Agent' ? null : $tema, 'mode' => 'dark']) }}"
                       @class(['rounded-lg px-3 py-1.5 transition', 'bg-slate-700 text-white shadow-sm' => $dark, 'text-slate-500 hover:text-slate-900' => ! $dark])>
                        Gelap
                    </a>
                </div>
            </div>

            <article @class([
                'rounded-3xl border p-8 sm:p-12 shadow-sm',
                'border-slate-800 bg-slate-900 text-slate-300' => $dark,
                'border-slate-200 bg-white text-slate-600' => ! $dark,
            ])>
                <p @class(['text-xs font-semibold tracking-[0.2em]', 'text-slate-500' => $dark, 'text-slate-400' => ! $dark])>
                    03 / KELOMPOK 04
                </p>

                <h1 @class(['mt-4 text-4xl sm:text-5xl font-bold leading-tight tracking-tight', 'text-white' => $dark, 'text-slate-900' => ! $dark])>
                    Agentic AI untuk<br>
                    <span class="font-medium italic text-indigo-500">keamanan web.</span>
                </h1>

                @if ($tema !== 'General Assistant Agent')
                    <p class="mt-4 text-sm font-medium text-indigo-500">Tema: {{ $namaTema }}</p>
                @endif

                <div class="mt-8 space-y-5 text-base leading-relaxed">
                    <p @class(['text-lg', 'text-slate-200' => $dark, 'text-slate-800' => ! $dark])>
                        Kami merancang aplikasi
                        <strong @class(['text-white' => $dark, 'text-slate-900' => ! $dark])>Dynamic Application Security Testing (DAST)</strong>
                        yang menggunakan Agentic AI untuk membantu menemukan kerentanan
                        pada aplikasi web secara mandiri.
                    </p>
                    <p>
                        Agen ini bekerja seperti pentester: memetakan halaman dan endpoint,
                        membaca respons HTTP, lalu menentukan uji berikutnya berdasarkan
                        temuan sebelumnya. Hasil pengujian dirangkum menjadi laporan yang
                        mudah dipahami, lengkap dengan saran perbaikan di tingkat kode.
                    </p>
                    <p>
                        Versi awal akan berfokus pada crawling halaman, analisis form,
                        pengiriman payload uji untuk SQL Injection dan XSS, serta validasi
                        respons. Pengujian dilakukan secara legal pada target lokal seperti
                        OWASP Juice Shop atau DVWA.
                    </p>
                </div>

                <div class="mt-10 grid gap-3 sm:grid-cols-3">
                    @foreach (['Reconnaissance', 'AI Reasoning', 'Security Report'] as $fitur)
                        <div @class([
                            'rounded-xl border px-4 py-4 text-center text-sm font-semibold',
                            'border-slate-700 bg-slate-800 text-white' => $dark,
                            'border-slate-200 bg-slate-50 text-slate-800' => ! $dark,
                        ])>
                            {{ $fitur }}
                        </div>
                    @endforeach
                </div>

                <div @class(['mt-10 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 border-t pt-6', 'border-slate-800' => $dark, 'border-slate-200' => ! $dark])>
                    <span class="text-xs font-semibold tracking-widest text-slate-500">AGENTIC SECURITY / MVP</span>
                    <a href="{{ route('home') }}" @class(['text-sm font-semibold underline underline-offset-4', 'text-white hover:text-indigo-300' => $dark, 'text-slate-900 hover:text-indigo-600' => ! $dark])>
                        Kembali ke Beranda ↗
                    </a>
                </div>
            </article>
        </div>
    </section>
</x-app-layout>
