<x-app-layout>
    <x-slot name="title">Kalkulator IPK</x-slot>

    <x-slot name="header">
        <x-page-header eyebrow="Akademik" title="Kalkulator IPK"
                       subtitle="Menghitung rata-rata IPK dua semester beserta predikatnya." />
    </x-slot>

    @php
        // Kelas lengkap ditulis di sini agar ikut ter-compile oleh Tailwind
        $tones = [
            'emerald' => 'bg-emerald-50 text-emerald-700 ring-emerald-200',
            'indigo'  => 'bg-indigo-50 text-indigo-700 ring-indigo-200',
            'sky'     => 'bg-sky-50 text-sky-700 ring-sky-200',
            'amber'   => 'bg-amber-50 text-amber-700 ring-amber-200',
            'rose'    => 'bg-rose-50 text-rose-700 ring-rose-200',
        ];
        $persen = $rataRata !== null ? min(100, max(0, $rataRata / 4 * 100)) : 0;
        $inputClass = 'block w-full rounded-xl border-slate-300 pe-14 text-lg font-semibold text-slate-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500';
    @endphp

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="grid gap-6 lg:grid-cols-5">

            {{-- Form --}}
            <form method="GET" action="{{ route('ipk.form') }}"
                  class="lg:col-span-2 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <h2 class="font-semibold text-slate-900">Masukkan IPK</h2>
                <p class="mt-1 text-sm text-slate-500">Skala 0.00 – 4.00, gunakan titik sebagai desimal.</p>

                <div class="mt-6 space-y-5">
                    @foreach (['ipk1' => ['Semester 1', $ipk1], 'ipk2' => ['Semester 2', $ipk2]] as $field => [$label, $nilai])
                        <div>
                            <label for="{{ $field }}" class="block text-sm font-medium text-slate-700">IPK {{ $label }}</label>
                            <div class="relative mt-1.5">
                                <input type="number" step="0.01" min="0" max="4" inputmode="decimal"
                                       id="{{ $field }}" name="{{ $field }}" placeholder="3.50" required
                                       value="{{ old($field, $nilai !== null ? number_format($nilai, 2, '.', '') : '') }}"
                                       class="{{ $inputClass }} @error($field) border-rose-400 @enderror">
                                <span class="pointer-events-none absolute inset-y-0 end-4 flex items-center text-sm text-slate-400">/ 4</span>
                            </div>
                            @error($field)
                                <p class="mt-1.5 text-sm text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>
                    @endforeach
                </div>

                <button type="submit"
                        class="mt-6 inline-flex w-full items-center justify-center gap-2 rounded-xl bg-indigo-600 px-4 py-3 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">
                    Hitung Rata-rata
                </button>

                @if ($rataRata !== null)
                    <a href="{{ route('ipk.form') }}" class="mt-3 block text-center text-sm font-medium text-slate-500 hover:text-slate-700">
                        Reset
                    </a>
                @endif
            </form>

            {{-- Hasil --}}
            <div class="lg:col-span-3 rounded-2xl border border-slate-200 bg-white p-6 sm:p-8 shadow-sm">
                @if ($rataRata !== null)
                    <div class="flex items-center justify-between gap-4">
                        <p class="text-sm font-medium text-slate-500">Rata-rata IPK</p>
                        <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold ring-1 ring-inset {{ $tones[$predikat['color']] }}">
                            {{ $predikat['label'] }}
                        </span>
                    </div>

                    <p class="mt-2 text-6xl font-bold tracking-tight text-slate-900">
                        {{ number_format($rataRata, 2) }}
                        <span class="text-2xl font-medium text-slate-400">/ 4.00</span>
                    </p>

                    <div class="mt-6 h-2.5 w-full overflow-hidden rounded-full bg-slate-100">
                        <div class="h-full rounded-full bg-gradient-to-r from-indigo-500 to-sky-400" style="width: {{ $persen }}%"></div>
                    </div>

                    <dl class="mt-8 grid grid-cols-2 gap-4">
                        <div class="rounded-xl bg-slate-50 p-4">
                            <dt class="text-xs font-medium uppercase tracking-wide text-slate-500">Semester 1</dt>
                            <dd class="mt-1 text-2xl font-bold text-slate-900">{{ number_format($ipk1, 2) }}</dd>
                        </div>
                        <div class="rounded-xl bg-slate-50 p-4">
                            <dt class="text-xs font-medium uppercase tracking-wide text-slate-500">Semester 2</dt>
                            <dd class="mt-1 text-2xl font-bold text-slate-900">{{ number_format($ipk2, 2) }}</dd>
                        </div>
                    </dl>

                    @php $selisih = $ipk2 - $ipk1; @endphp
                    <p class="mt-6 text-sm text-slate-600">
                        @if ($selisih > 0)
                            IPK naik <strong class="text-emerald-600">+{{ number_format($selisih, 2) }}</strong> dari semester 1 ke semester 2. Pertahankan!
                        @elseif ($selisih < 0)
                            IPK turun <strong class="text-rose-600">{{ number_format($selisih, 2) }}</strong> dari semester 1 ke semester 2. Masih bisa dikejar di semester berikutnya.
                        @else
                            IPK stabil di kedua semester.
                        @endif
                    </p>
                @else
                    <div class="flex h-full min-h-[18rem] flex-col items-center justify-center text-center">
                        <span class="flex h-14 w-14 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-600">
                            <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342" /></svg>
                        </span>
                        <h3 class="mt-4 font-semibold text-slate-900">Belum ada hasil</h3>
                        <p class="mt-1 max-w-xs text-sm text-slate-500">Isi IPK semester 1 dan 2 di samping, lalu tekan <em>Hitung Rata-rata</em>.</p>
                        <p class="mt-4 text-xs text-slate-400">Bisa juga lewat URL, contoh: <code class="rounded bg-slate-100 px-1.5 py-0.5">/kalkulator-ipk/3.50/3.75</code></p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
